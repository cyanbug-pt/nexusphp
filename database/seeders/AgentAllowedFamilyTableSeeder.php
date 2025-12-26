<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AgentAllowedFamilyTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('agent_allowed_family')->delete();

        \DB::table('agent_allowed_family')->insert(array (
            0 =>
            array (
                'id' => 1,
                'family' => 'uTorrent 2.x.x',
                'start_name' => 'uTorrent 2.0(build 17624)',
                   'peer_id_pattern' => '/^-UT2([0-9])([0-9])([0-9])-/',
                   'peer_id_match_num' => 3,
                   'peer_id_matchtype' => 'dec',
                   'peer_id_start' => '-UT2000-',
                   'agent_pattern' => '/^uTorrent\\/2([0-9])([0-9])([0-9])/',
                   'agent_match_num' => 3,
                   'agent_matchtype' => 'dec',
                   'agent_start' => 'uTorrent/2000',
                   'exception' => 'no',
                   'allowhttps' => 'yes',
                   'comment' => '',
                   'hits' => 0,
            ),
            1 =>
            array (
                'id' => 2,
                'family' => 'uTorrent 3.x',
                'start_name' => 'uTorrent/3000',
                'peer_id_pattern' => '/^-UT3([0-9])([0-9])([0-9])-/',
                   'peer_id_match_num' => 3,
                   'peer_id_matchtype' => 'dec',
                   'peer_id_start' => '-UT3000-',
                   'agent_pattern' => '/^uTorrent\\/3([0-9])([0-9])([0-9])/',
                   'agent_match_num' => 3,
                   'agent_matchtype' => 'dec',
                   'agent_start' => 'uTorrent/3000',
                   'exception' => 'no',
                   'allowhttps' => 'yes',
                   'comment' => '',
                   'hits' => 0,
            ),
            2 =>
            array (
                'id' => 3,
                'family' => 'uTorrent 3.x',
                'start_name' => 'uTorrent',
                'peer_id_pattern' => '',
                'peer_id_match_num' => 0,
                'peer_id_matchtype' => 'dec',
                'peer_id_start' => '-UT355W-',
                'agent_pattern' => '/^uTorrent/',
                'agent_match_num' => 0,
                'agent_matchtype' => 'dec',
                'agent_start' => 'uTorrent',
                'exception' => 'no',
                'allowhttps' => 'yes',
                'comment' => '',
                'hits' => 6,
            ),
            3 =>
            array (
                'id' => 4,
                'family' => 'BiglyBT 3.x',
                'start_name' => 'BiglyBT 3.0.0.0',
                'peer_id_pattern' => '/^-BI3([0-9])([0-9])([0-9])-/',
                   'peer_id_match_num' => 3,
                   'peer_id_matchtype' => 'dec',
                   'peer_id_start' => '-BI3000-',
                   'agent_pattern' => '/^BiglyBT\\ /3\\.([0-9])\\.([0-9])\\.([0-9])/',
                   'agent_match_num' => 3,
                   'agent_matchtype' => 'dec',
                   'agent_start' => 'BiglyBT/3.0.0.0',
                   'exception' => 'no',
                   'allowhttps' => 'yes',
                   'comment' => NULL,
                   'hits' => 0,
            ),
            4 =>
            array (
                'id' => 5,
                'family' => 'Deluge 1.x',
                'start_name' => 'Deluge 1.0.0',
                'peer_id_pattern' => '/^-DE1([0-9])/',
                   'peer_id_match_num' => 1,
                   'peer_id_matchtype' => 'dec',
                   'peer_id_start' => '-DE10',
                   'agent_pattern' => '/^Deluge 1\\.([0-9])\\.([0-9])/',
                   'agent_match_num' => 2,
                   'agent_matchtype' => 'dec',
                   'agent_start' => 'Deluge 1.0.0',
                   'exception' => 'no',
                   'allowhttps' => 'yes',
                   'comment' => '',
                   'hits' => 0,
            ),
            5 =>
            array (
                'id' => 6,
                'family' => 'Deluge 2.x',
                'start_name' => 'Deluge 2.0.0',
                'peer_id_pattern' => '/^-DE2([0-9])([0-9])/',
                   'peer_id_match_num' => 2,
                   'peer_id_matchtype' => 'dec',
                   'peer_id_start' => '-DE200',
                   'agent_pattern' => '/^Deluge\\/2\\.([0-9])\\.([0-9])/',
                   'agent_match_num' => 2,
                   'agent_matchtype' => 'dec',
                   'agent_start' => 'Deluge/2.0.0',
                   'exception' => 'no',
                   'allowhttps' => 'yes',
                   'comment' => '',
                   'hits' => 0,
            ),
            6 =>
            array (
                'id' => 7,
                'family' => 'RTorrent 0.x(with libtorrent 0.x)',
                   'start_name' => 'rTorrent 0.8.0 (with libtorrent 0.12.0)',
                   'peer_id_pattern' => '/^-lt([0-9A-Z])([0-9A-Z])([0-9A-Z])([0-9A-Z])-/',
                   'peer_id_match_num' => 4,
                   'peer_id_matchtype' => 'hex',
                   'peer_id_start' => '-lt0C00-',
                   'agent_pattern' => '/^rtorrent\\/0\\.([0-9]{1,2})\\.([0-9])\\/0\\.([1-9][0-9]*)\\.(0|[1-9][0-9]*)/',
                   'agent_match_num' => 4,
                   'agent_matchtype' => 'dec',
                   'agent_start' => 'rtorrent/0.8.0/0.12.0',
                   'exception' => 'no',
                   'allowhttps' => 'yes',
                   'comment' => '',
                   'hits' => 0,
            ),
            7 =>
            array (
                'id' => 8,
                'family' => 'Transmission2.x',
                'start_name' => 'Transmission 2.0',
                'peer_id_pattern' => '/^-TR2([0-9])([0-9])([0-9])-/',
                   'peer_id_match_num' => 3,
                   'peer_id_matchtype' => 'dec',
                   'peer_id_start' => '-TR2000-',
                   'agent_pattern' => '/^Transmission\\/2\\.([0-9])([0-9])/',
                   'agent_match_num' => 3,
                   'agent_matchtype' => 'dec',
                   'agent_start' => 'Transmission/2.00',
                   'exception' => 'no',
                   'allowhttps' => 'yes',
                   'comment' => '',
                   'hits' => 1,
            ),
            8 =>
            array (
                'id' => 9,
                'family' => 'Transmission3.x',
                'start_name' => 'Transmission 3.0',
                'peer_id_pattern' => '/^-TR3([0-9])([0-9])([0-9])-/',
                   'peer_id_match_num' => 3,
                   'peer_id_matchtype' => 'dec',
                   'peer_id_start' => '-TR3000-',
                   'agent_pattern' => '/^Transmission\\/3\\.([0-9])([0-9])/',
                   'agent_match_num' => 3,
                   'agent_matchtype' => 'dec',
                   'agent_start' => 'Transmission/3.00',
                   'exception' => 'no',
                   'allowhttps' => 'yes',
                   'comment' => '',
                   'hits' => 0,
            ),
            9 =>
            array (
                'id' => 10,
                'family' => 'Transmission4.x',
                'start_name' => 'Transmission 4.0.0',
                'peer_id_pattern' => '/^-TR4([0-9])([0-9])([0-9])-/',
                   'peer_id_match_num' => 3,
                   'peer_id_matchtype' => 'dec',
                   'peer_id_start' => '-TR4000-',
                   'agent_pattern' => '/^Transmission\\/4\\.([0-9])\\.([0-9])/',
                   'agent_match_num' => 2,
                   'agent_matchtype' => 'dec',
                   'agent_start' => 'Transmission/4.0.0',
                   'exception' => 'no',
                   'allowhttps' => 'yes',
                   'comment' => NULL,
                   'hits' => 0,
            ),
            10 =>
            array (
                'id' => 11,
                'family' => 'qBittorrent 4.x',
                'start_name' => 'qBittorrent 4.0.0',
                'peer_id_pattern' => '/^-qB4([0-9])([0-9])/',
                   'peer_id_match_num' => 2,
                   'peer_id_matchtype' => 'dec',
                   'peer_id_start' => '-qB400',
                   'agent_pattern' => '/^qBittorrent\\/4\\.([0-9])\\.([0-9])/',
                   'agent_match_num' => 2,
                   'agent_matchtype' => 'dec',
                   'agent_start' => 'qBittorrent/4.0.0',
                   'exception' => 'no',
                   'allowhttps' => 'yes',
                   'comment' => '',
                   'hits' => 3,
            ),
            11 =>
            array (
                'id' => 12,
                'family' => 'qBittorrent 5.x',
                'start_name' => 'qBittorrent 5.0.0',
                'peer_id_pattern' => '/^-qB5([0-9])([0-9])/',
                   'peer_id_match_num' => 2,
                   'peer_id_matchtype' => 'dec',
                   'peer_id_start' => '-qB500',
                   'agent_pattern' => '/^qBittorrent\\/5\\.([0-9])\\.([0-9])/',
                   'agent_match_num' => 2,
                   'agent_matchtype' => 'dec',
                   'agent_start' => 'qBittorrent/5.0.0',
                   'exception' => 'no',
                   'allowhttps' => 'yes',
                   'comment' => NULL,
                   'hits' => 0,
            ),
        ));

    }
}
