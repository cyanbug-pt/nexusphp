目前多语言存在以下 2 套方案：
- 旧的 Nexus 环境下网页所用翻译文件，通过 `require_once(get_langfile_path())` 引入语言文件再使用。  
- 新的定义到 `resources/lang` 下，通过 nexus_trans() 调用。 

旧的保留不变，新增功能一律使用新方式。新方式无论是 Nexus 环境还是 Laravel 环境均可使用。

<hr/>

Currently there are 2 solutions for multilingualism:
- The old Nexus environment uses translation files for web pages, which are imported into the language file via `require_once(get_langfile_path())` and then used.
- The new ones are defined under `resources/lang` and called via `nexus_trans()`.

Keep the old one intact, and use the new way for all new functionality. The new approach can be used in both Nexus and Laravel environments.
