<?php

use Codeception\Util\Fixtures;
use Page\Admin\AuthorityManagePage;

/**
 * @group admin
 * @group admin03
 * @group systeminformation
 * @group ea8
 */
class EA08SysteminfoCest
{
    public function _before(\AcceptanceTester $I)
    {
        $I->loginAsAdmin();
    }

    public function _after(\AcceptanceTester $I)
    {
    }

    /**
     * @group vaddy
     */
    public function systeminfo_システム情報(\AcceptanceTester $I)
    {
        $I->wantTo('EA0801-UC01-T01 システム情報');

        // 表示
        $config = Fixtures::get('config');
        $I->amOnPage('/'.$config['admin_route'].'/setting/system/system');
        $I->see('システム設定システム情報', '#main .page-header');

        $I->see('システム情報', '#main .container-fluid div:nth-child(1) .box-header .box-title');
        $I->see('PHP情報', '#main .container-fluid div:nth-child(2) .box-header .box-title');
    }

    public function systeminfo_メンバー管理表示(\AcceptanceTester $I)
    {
        $I->wantTo('EA0802-UC01-T01 メンバー管理 - 表示');

        // 表示
        $config = Fixtures::get('config');
        $I->amOnPage('/'.$config['admin_route'].'/setting/system/member');
        $I->see('システム設定メンバー管理', '#main .page-header');

        $I->see('メンバー管理', '#main .container-fluid div:nth-child(1) .box-header .box-title');
        $I->see('新規登録', '#main .container-fluid .btn_area a');
    }

    /**
     * @group vaddy
     */
    public function systeminfo_メンバー管理登録実施(\AcceptanceTester $I)
    {
        $I->wantTo('EA0803-UC01-T01 メンバー管理 - 登録 - 登録実施');

        // 表示
        $config = Fixtures::get('config');
        $I->amOnPage('/'.$config['admin_route'].'/setting/system/member');
        $I->see('システム設定メンバー管理', '#main .page-header');

        $I->click('#main .container-fluid .btn_area a');
        $I->see('メンバー登録・編集', '#main .container-fluid div:nth-child(1) .box-header .box-title');

        $I->fillField(['id' => 'admin_member_name'], 'admintest');
        $I->fillField(['id' => 'admin_member_department'], 'admintest department');
        $I->fillField(['id' => 'admin_member_login_id'], 'admintest');
        $I->fillField(['id' => 'admin_member_password_first'], 'password');
        $I->fillField(['id' => 'admin_member_password_second'], 'password');
        $I->selectOption(['id' => 'admin_member_Authority'], 'システム管理者');
        $I->selectOption(['id' => 'admin_member_Work_1'], '稼働');
        $I->click('#aside_column button');
        $I->see('メンバーを保存しました。', '#main .container-fluid div:nth-child(1) .alert-success');

        $I->see('メンバー管理', '#main .container-fluid div:nth-child(1) .box-header .box-title');
        $I->see('admintest', '#main .container-fluid .table_list .table tbody tr:nth-child(1) td:nth-child(1)');
    }

    public function systeminfo_メンバー管理登録未実施(\AcceptanceTester $I)
    {
        $I->wantTo('EA0803-UC01-T02 メンバー管理 - 登録 - 登録未実施');

        // 表示
        $config = Fixtures::get('config');
        $I->amOnPage('/'.$config['admin_route'].'/setting/system/member');
        $I->see('システム設定メンバー管理', '#main .page-header');

        $I->click('#main .container-fluid .btn_area a');
        $I->see('メンバー登録・編集', '#main .container-fluid div:nth-child(1) .box-header .box-title');

        $I->fillField(['id' => 'admin_member_name'], 'admintest2');
        $I->fillField(['id' => 'admin_member_department'], 'admintest department');
        $I->fillField(['id' => 'admin_member_login_id'], 'admintest');
        $I->fillField(['id' => 'admin_member_password_first'], 'password');
        $I->fillField(['id' => 'admin_member_password_second'], 'password');
        $I->selectOption(['id' => 'admin_member_Authority'], 'システム管理者');
        $I->selectOption(['id' => 'admin_member_Work_1'], '稼働');
        $I->click('#aside_wrap .btn_area a');

        $I->see('メンバー管理', '#main .container-fluid div:nth-child(1) .box-header .box-title');
        $I->dontSee('admintest2', '#main .container-fluid .table_list .table tbody tr:nth-child(1) td:nth-child(1)');
    }

    public function systeminfo_メンバー管理登録異常(\AcceptanceTester $I)
    {
        $I->wantTo('EA0803-UC01-T03 メンバー管理 - 登録 - 異常パターン');

        // 表示
        $config = Fixtures::get('config');
        $I->amOnPage('/'.$config['admin_route'].'/setting/system/member');
        $I->see('システム設定メンバー管理', '#main .page-header');

        $I->click('#main .container-fluid .btn_area a');
        $I->see('メンバー登録・編集', '#main .container-fluid div:nth-child(1) .box-header .box-title');

        $I->click('#aside_column button');
        $I->see('入力されていません。', '#form1 div:nth-child(1) div');
    }

    /**
     * @group vaddy
     */
    public function systeminfo_メンバー管理編集実施(\AcceptanceTester $I)
    {
        $I->wantTo('EA0803-UC02-T01 メンバー管理 - 編集 - 編集実施');

        // 表示
        $config = Fixtures::get('config');
        $I->amOnPage('/'.$config['admin_route'].'/setting/system/member');
        $I->see('システム設定メンバー管理', '#main .page-header');

        $I->click('#main .container-fluid .table_list .table tbody tr:nth-child(1) td:nth-child(5) .dropdown a');
        $I->click('#main .container-fluid .table_list .table tbody tr:nth-child(1) td:nth-child(5) .dropdown .dropdown-menu li:nth-child(1) a');
        $I->see('メンバー登録・編集', '#main .container-fluid div:nth-child(1) .box-header .box-title');

        $I->fillField(['id' => 'admin_member_name'], 'administrator');
        $I->click('#aside_column button');

        // FIXME 以下の不具合のためシステムエラーが発生する
        // https://github.com/EC-CUBE/eccube-api/pull/60
        $findPluginByCode = Fixtures::get('findPluginByCode');
        $Plugin = $findPluginByCode('EccubeApi');
        if ($Plugin) {
            $I->amGoingTo('EccubeApi プラグインを発見したため、不具合を回避しました。 詳細: https://github.com/EC-CUBE/eccube-api/pull/60');
        } else {
            $I->see('メンバーを保存しました。', '#main .container-fluid div:nth-child(1) .alert-success');
            $I->see('メンバー管理', '#main .container-fluid div:nth-child(1) .box-header .box-title');
            $I->see('administrator', '#main .container-fluid .table_list .table tbody tr:nth-child(1) td:nth-child(1)');
        }
    }

    public function systeminfo_メンバー管理編集未実施(\AcceptanceTester $I)
    {
        $I->wantTo('EA0803-UC02-T02 メンバー管理 - 編集 - 編集未実施');

        // 表示
        $config = Fixtures::get('config');
        $I->amOnPage('/'.$config['admin_route'].'/setting/system/member');
        $I->see('システム設定メンバー管理', '#main .page-header');

        $I->click('#main .container-fluid .table_list .table tbody tr:nth-child(1) td:nth-child(5) .dropdown a');
        $I->click('#main .container-fluid .table_list .table tbody tr:nth-child(1) td:nth-child(5) .dropdown .dropdown-menu li:nth-child(1) a');
        $I->see('メンバー登録・編集', '#main .container-fluid div:nth-child(1) .box-header .box-title');

        $I->fillField(['id' => 'admin_member_name'], 'administrator2');
        $I->click('#aside_wrap .btn_area a');

        $I->see('メンバー管理', '#main .container-fluid div:nth-child(1) .box-header .box-title');
        $I->dontSee('administrator2', '#main .container-fluid .table_list .table tbody tr:nth-child(1) td:nth-child(1)');
    }

    public function systeminfo_メンバー管理編集異常(\AcceptanceTester $I)
    {
        $I->wantTo('EA0803-UC03-T01 メンバー管理 - 編集 - 異常パターン');

        // 表示
        $config = Fixtures::get('config');
        $I->amOnPage('/'.$config['admin_route'].'/setting/system/member');
        $I->see('システム設定メンバー管理', '#main .page-header');

        $I->click('#main .container-fluid .table_list .table tbody tr:nth-child(1) td:nth-child(5) .dropdown a');
        $I->click('#main .container-fluid .table_list .table tbody tr:nth-child(1) td:nth-child(5) .dropdown .dropdown-menu li:nth-child(1) a');
        $I->see('メンバー登録・編集', '#main .container-fluid div:nth-child(1) .box-header .box-title');

        $I->fillField(['id' => 'admin_member_name'], '');
        $I->click('#aside_column button');

        $I->see('入力されていません。', '#form1 div:nth-child(1) div');
    }

    /**
     * @group vaddy
     */
    public function systeminfo_メンバー管理登録下へ(\AcceptanceTester $I)
    {
        $I->wantTo('EA0802-UC01-T02 メンバー管理 - 下へ');

        // 表示
        $config = Fixtures::get('config');
        $I->amOnPage('/'.$config['admin_route'].'/setting/system/member');
        $I->see('システム設定メンバー管理', '#main .page-header');

        $I->click('#main .container-fluid .table_list .table tbody tr:nth-child(1) td:nth-child(5) .dropdown a');
        $I->click('#main .container-fluid .table_list .table tbody tr:nth-child(1) td:nth-child(5) .dropdown .dropdown-menu li:nth-child(3) a');

        $I->see('管理者', '#main .container-fluid .table_list .table tbody tr:nth-child(1) td:nth-child(1)');
    }

    public function systeminfo_メンバー管理登録上へ(\AcceptanceTester $I)
    {
        $I->wantTo('EA0802-UC01-T03 メンバー管理 - 上へ');

        // 表示
        $config = Fixtures::get('config');
        $I->amOnPage('/'.$config['admin_route'].'/setting/system/member');
        $I->see('システム設定メンバー管理', '#main .page-header');

        $I->click('#main .container-fluid .table_list .table tbody tr:nth-child(2) td:nth-child(5) .dropdown a');
        $I->click('#main .container-fluid .table_list .table tbody tr:nth-child(2) td:nth-child(5) .dropdown .dropdown-menu li:nth-child(3) a');

        $I->see('管理者', '#main .container-fluid .table_list .table tbody tr:nth-child(2) td:nth-child(1)');
    }

    /**
     * @group vaddy
     */
    public function systeminfo_メンバー管理削除(\AcceptanceTester $I)
    {
        $I->wantTo('EA0802-UC01-T06 メンバー管理 - 削除');

        // 表示
        $config = Fixtures::get('config');
        $I->amOnPage('/'.$config['admin_route'].'/setting/system/member');
        $I->see('システム設定メンバー管理', '#main .page-header');

        $I->click('#main .container-fluid .table_list .table tbody tr:nth-child(1) td:nth-child(5) .dropdown a');
        $I->click('#main .container-fluid .table_list .table tbody tr:nth-child(1) td:nth-child(5) .dropdown .dropdown-menu li:nth-child(2) a');
        $I->acceptPopup();

        $I->see('メンバーを削除しました。', '#main .container-fluid div:nth-child(1) .alert-success');
        $I->see('管理者', '#main .container-fluid .table_list .table tbody tr:nth-child(1) td:nth-child(1)');
    }

    public function systeminfo_メンバー管理自ユーザー削除(\AcceptanceTester $I)
    {
        $I->wantTo('EA0802-UC01-T07 メンバー管理 - 自ユーザー削除');

        // 表示
        $config = Fixtures::get('config');
        $I->amOnPage('/'.$config['admin_route'].'/setting/system/member');
        $I->see('システム設定メンバー管理', '#main .page-header');

        $I->click('#main #member_list__menu_box--2 a');
        $I->see('削除', '#main #member_list__menu--2 li:nth-child(2) a');
        $href = $I->grabAttributeFrom('#main #member_list__menu--2 li:nth-child(2) a', 'href');
        $I->assertEquals('', $href, $href.' が一致しません');
    }

    public function systeminfo_セキュリティ管理表示(\AcceptanceTester $I)
    {
        $I->wantTo('EA0804-UC01-T01 セキュリティ管理 - 表示');

        // 表示
        $config = Fixtures::get('config');
        $I->amOnPage('/'.$config['admin_route'].'/setting/system/security');
        $I->see('システム設定セキュリティ管理', '#main .page-header');
        $I->see('セキュリティ機能設定', '#main .container-fluid div:nth-child(1) .box-header .box-title');
    }

    /**
     * @group vaddy
     */
    public function systeminfo_セキュリティ管理ディレクトリ名(\AcceptanceTester $I)
    {
        $I->wantTo('EA0804-UC01-T02 セキュリティ管理 - ディレクトリ名変更');

        // 表示
        $config = Fixtures::get('config');
        $I->amOnPage('/'.$config['admin_route'].'/setting/system/security');
        $I->see('システム設定セキュリティ管理', '#main .page-header');

        $I->fillField(['id' => 'admin_security_admin_route_dir'], 'test');
        $I->click('#aside_column div div div div div button');
        $I->loginAsAdmin('', '', 'test');

        $I->amOnPage('/test/setting/system/security');
        $I->fillField(['id' => 'admin_security_admin_route_dir'], $config['admin_route']);
        $I->click('#aside_column div div div div div button');
        $I->loginAsAdmin();
    }

    public function systeminfo_セキュリティ管理SSL(\AcceptanceTester $I)
    {
        $I->wantTo('EA0804-UC01-T04 セキュリティ管理 - SSL強制');

        $httpBaseUrl = $I->getBaseUrl();
        $I->amOnUrl($httpBaseUrl);
        $I->assertRegExp('/^http:\/\//', $I->executeJS('return location.href'), 'httpsにリダイレクトされない');

        $config = Fixtures::get('config');
        $httpsBaseUrl = str_replace('http://', 'https://', $httpBaseUrl);
        $I->amOnUrl($httpsBaseUrl.$config['admin_route'].'/setting/system/security');
        $I->checkOption(['id' => 'admin_security_force_ssl']);
        $I->click('#aside_column div div div div div button');

        // httpでアクセスしたらhttpsにリダイレクトされる
        $I->amOnUrl($httpBaseUrl);
        $I->assertRegExp('/^https:\/\//', $I->executeJS('return location.href'), 'httpsにリダイレクトされる');

        // 後続テストのために戻しておく
        $I->amOnUrl($httpsBaseUrl.$config['admin_route'].'/setting/system/security');
        $I->uncheckOption(['id' => 'admin_security_force_ssl']);
        $I->click('#aside_column div div div div div button');
    }

    /**
     * @group vaddy
     */
    public function systeminfo_権限管理追加(\AcceptanceTester $I)
    {
        $I->wantTo('EA0805-UC01-T01 権限管理 - 追加');

        AuthorityManagePage::go($I)
            ->行追加()
            ->入力(1, ['0' => 'システム管理者'], '/content')
            ->入力(2, ['0' => 'システム管理者'], '/store')
            ->登録();

        $I->see('権限設定を保存しました。', AuthorityManagePage::$完了メッセージ);
        $I->dontSee('コンテンツ管理', '#side ul');
        $I->dontSee('オーナーズストア', '#side ul');
    }

    /**
     * @group vaddy
     */
    public function systeminfo_権限管理削除(\AcceptanceTester $I)
    {
        $I->wantTo('EA0805-UC02-T01 権限管理 - 削除');

        AuthorityManagePage::go($I)
            ->行削除(2)
            ->行削除(1)
            ->登録();

        $I->see('権限設定を保存しました。', AuthorityManagePage::$完了メッセージ);
        $I->see('コンテンツ管理', '#side ul');
        $I->see('オーナーズストア', '#side ul');
    }

    /**
     * @group vaddy
     */
    public function systeminfo_ログ表示(\AcceptanceTester $I)
    {
        $I->wantTo('EA0806-UC01-T01 ログ表示');

        // 表示
        $config = Fixtures::get('config');
        $I->amOnPage('/'.$config['admin_route'].'/setting/system/log');
        $I->see('システム設定EC-CUBE ログ表示', '#main .page-header');

        $log = $I->grabValueFrom(['id' => 'admin_system_log_files']);
        $expect = "site_".date('Y-m-d').".log";
        $I->assertEquals($expect, $log);

        $I->fillField(['id' => 'line-max'], '1');
        $I->click(['css' => '#form1 button']);

        $I->dontSeeElement(['css' => '#main .container-fluid .box table tbody tr:nth-child(2)']);
    }

    /**
     * @group vaddy
     */
    public function systeminfo_マスターデータ管理(\AcceptanceTester $I)
    {
        $I->wantTo('EA0807-UC01-T01 マスターデータ管理');

        // 表示
        $config = Fixtures::get('config');
        $I->amOnPage('/'.$config['admin_route'].'/setting/system/masterdata');
        $I->see('システム設定マスターデータ管理', '#main .page-header');

        $I->selectOption(['id' => 'admin_system_masterdata_masterdata'], ['Eccube-Entity-Master-Sex' => 'mtb_sex']);
        $I->click('#form1 button');

        $I->fillField(['css' => '#form2 table tbody tr:nth-child(4) td:nth-child(1) input'], '3');
        $I->fillField(['css' => '#form2 table tbody tr:nth-child(4) td:nth-child(2) input'], '無回答');

        $I->click(['css' => '#form2 #aside_column button']);

        $I->see('登録が完了しました。', '#main .container-fluid div:nth-child(1) .alert-success');
        $I->amOnPage('/'.$config['admin_route'].'/customer/new');
        $I->see('無回答', '#customer_form #admin_customer_sex');
    }

    /**
     * ATTENTION 後続のテストが失敗するため、最後に実行する必要がある
     */
    public function systeminfo_セキュリティ管理IP制限(\AcceptanceTester $I, \Codeception\Scenario $scenario)
    {
        $I->wantTo('EA0804-UC01-T03 セキュリティ管理 - IP制限');

        $findPlugins = Fixtures::get('findPlugins');
        $Plugins = $findPlugins();
        if (is_array($Plugins) && count($Plugins) > 0 ) {
            $scenario->skip('プラグインのアンインストールが必要なため、テストをスキップします');
        }

        // 表示
        $config = Fixtures::get('config');
        $I->amOnPage('/'.$config['admin_route'].'/setting/system/security');
        $I->see('システム設定セキュリティ管理', '#main .page-header');

        $I->fillField(['id' => 'admin_security_admin_allow_host'], '1.1.1.1');
        $I->click('#aside_column div div div div div button');

        $I->amOnPage('/'.$config['admin_route'].'/');
        $I->see('アクセスできません。', '#main .container-fluid h1');

        $test_config = Fixtures::get('test_config');
        $eccube = $test_config['eccube_path'];
        $configfile = $eccube."/app/config/eccube/config.yml";
        $lines = file($configfile);
        $fh = fopen($configfile, 'w');
        foreach ($lines as $line) {
            if(preg_match('/1\.1\.1\.1/', $line)) {
                continue;
            }
            fwrite($fh, $line);
        }
        fclose($fh);
    }
}
