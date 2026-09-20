# Tracker and list-query performance changes

## Behavior

- `announce.php` uses the existing database-aware binary binding for its second peer lookup. MySQL must receive the original 20 bytes, not a hex string.
- Stopped events skip the unused peer-list query while retaining the self lookup and accounting path.
- Presence-only `users.last_announce_at` writes are coalesced per user for 60 seconds. Upload/download and other business-field updates always execute. Timestamps use `GREATEST(COALESCE(...), ...)` to avoid moving backwards when requests finish out of order.
- Redis failure falls back to SQL. SQL failures release only the caller's throttle token. A process crash may leave a token until its 60-second expiry; this affects presence freshness, not accounting writes.
- SQL-backed torrent-list totals are cached for 15 seconds by user, permission fields and complete SQL. Torrent rows and authorization remain live. Zero totals are cached, including numeric strings returned by the Redis adapter. Cache failure falls back to SQL, and SQL exceptions propagate.
- The migration adds `(type,date,id)` and `(date,id)` shoutbox indexes. MySQL uses online DDL with a 5-second metadata-lock wait; other drivers use the schema builder.

## Deployment

Only run this migration, rather than applying unrelated pending migrations:

```bash
php artisan migrate --pretend --force --path=database/migrations/2026_09_20_030000_add_shoutbox_order_indexes.php
php artisan migrate --force --path=database/migrations/2026_09_20_030000_add_shoutbox_order_indexes.php
php-fpm8.4 -t && systemctl reload php8.4-fpm
```

Use the application's operating-system account for artisan. Check live schema before retrying a partially completed deployment.

## Validation

```bash
php8.4 vendor/bin/phpunit --no-configuration --bootstrap vendor/autoload.php tests/Unit
```

The added unit tests cover expiry, user isolation, accounting bypass, database failure and token ownership, cache outages, cached zero totals, permission/query isolation, and SQL exception propagation. They do not boot the production database.

Deployment also checked the real application Redis adapter with isolated keys and fake database callbacks, without changing account records. Both real Redis throttling/Lua cleanup and cached zero counts passed.

Before the indexes, recent-message queries used table scans/filesort over roughly 556,000 rows, with historical mean times around 520–607 ms. After the indexes, `EXPLAIN ANALYZE` for 70 rows used reverse index scans/lookups and took about 0.11–0.16 ms in a warm sample. These are different measurement methods; do not treat their ratio as a controlled benchmark.

## Configuration outside Git

On this server, `/etc/mysql/mysql.conf.d/mysqld.cnf` now explicitly uses `innodb_redo_log_capacity=2G` instead of the deprecated `innodb_log_file_size=1G`. The effective redo capacity was already 2 GiB. The same runtime capacity was set without restarting MySQL. Buffer pool remains 12 GiB and commit flushing remains 1.

Original source/config backups: `/root/nexusphp-fixes-20260920/`.

## Rollback

Revert only this performance commit, preserve unrelated work, then reload PHP-FPM. Old code works with the added indexes, so index removal is not needed for an urgent code rollback. The migration's `down()` removes only its two named indexes; inspect migration history before running any rollback, and do not roll back unrelated migrations.

Restoring the saved MySQL config returns to the old spelling of the same redo capacity. Throttle/count keys expire automatically; never flush the shared Redis database.
