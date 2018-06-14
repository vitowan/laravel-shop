<?php
global $app;
helper::cd($app->getBasePath());
helper::import('E:\phpStudy\WWW\ranzhi\app\sys\upgrade\model.php');
helper::cd();
class extupgradeModel extends upgradeModel 
{

    public function execute($fromVersion)
    {
if($fromVersion < '4_1') 
{
    $this->execSQL($this->app->getBasepath() . 'db' . DS . 'xuanxuan.sql');
}
else
{
    $xuanxuanVersion = !empty($this->config->xuanxuan->global->version) ? $this->config->xuanxuan->global->version : '1.0';
    switch($xuanxuanVersion)
    {
    case '1.0' : $this->execSQL($this->getUpgradeFile('xuanxuan1.0'));
    case '1.1.0' :
    case '1.1.1' : $this->execSQL($this->getUpgradeFile('xuanxuan1.1.1'));
    default : $this->loadModel('setting')->setItem('system.sys.xuanxuan.global.version', $this->config->xuanxuan->version);
    }
}
        $result = array();
    
        /* Delete useless file.*/
        foreach($this->config->delete as $deleteFiles)
        {
            $basePath = $this->app->getBasePath();
            foreach($deleteFiles as $file)
            {
                $fullPath = $basePath . str_replace('/', DIRECTORY_SEPARATOR, $file);
                if(is_dir($fullPath)  and !rmdir($fullPath))  $result[] = sprintf($this->lang->upgrade->deleteDir, $fullPath);
                if(is_file($fullPath) and !unlink($fullPath)) $result[] = sprintf($this->lang->upgrade->deleteFile, $fullPath);
            }
        }
        if(!empty($result)) return array('' => $this->lang->upgrade->deleteTips) + $result;
    
        switch($fromVersion)
        {
            case '1_0_beta':
                $this->execSQL($this->getUpgradeFile('1.0.beta'));
                $this->createCashEntry();
            case '1_1_beta':
                $this->execSQL($this->getUpgradeFile('1.1.beta'));
                $this->createTeamEntry();
            case '1_2_beta':
                $this->execSQL($this->getUpgradeFile('1.2.beta'));
                $this->transformBlock();
                $this->changeBuildinName();
                $this->computeContactInfo();
            case '1_3_beta':
                $this->execSQL($this->getUpgradeFile('1.3.beta'));
                $this->setCompanyContent();
            case '1_4_beta':
                $this->upgradeContractName();
                $this->upgradeProjectMember();
                $this->safeDropColumns(TABLE_PROJECT, 'master,member');

                /* Exec sqls must after fix data. */
                $this->execSQL($this->getUpgradeFile('1.4.beta'));
            case '1_5_beta':
                $this->execSQL($this->getUpgradeFile('1.5.beta'));
                $this->upgradeEntryLogo();
                $this->upgradeReturnRecords();
                $this->upgradeDeliveryRecords();
                $this->addSearchPriv();
            case '1_6':
                $this->execSQL($this->getUpgradeFile('1.6'));
                $this->addPrivs();
            case '1_7':
                $this->toLowerTable();
                $this->updateAppOrder();
            case '2_0':
                $this->execSQL($this->getUpgradeFile('2.0'));
                $this->fixClosedTask();
                $this->setSalesGroup();
                $this->fixOrderProduct();
            case '2_1':
                $this->execSQL($this->getUpgradeFile('2.1'));
            case '2_2':
                $this->processTradeDesc();
            case '2_3':
                $this->processCustomerEditedDate();
                $this->execSQL($this->getUpgradeFile('2.3'));
            case '2_4':
                $this->addAttendPriv();
                $this->execSQL($this->getUpgradeFile('2.4'));
            case '2_5':
                $this->execSQL($this->getUpgradeFile('2.5'));
            case '2_6':
                $this->execSQL($this->getUpgradeFile('2.6'));
            case '2_7':
                $this->processBlockType();
                $this->execSQL($this->getUpgradeFile('2.7'));
            case '3_0':
                $this->execSQL($this->getUpgradeFile('3.0'));
            case '3_1':
                $this->processStatusForContact();
                $this->execSQL($this->getUpgradeFile('3.1'));
            case '3_2':
                $this->execSQL($this->getUpgradeFile('3.2'));
            case '3_2_1':
                $this->execSQL($this->getUpgradeFile('3.2.1'));
            case '3_3':
                $this->execSQL($this->getUpgradeFile('3.3'));
            case '3_4':
                $this->execSQL($this->getUpgradeFile('3.4'));
                $this->updateTradeCategories();
            case '3_5':
                $this->execSQL($this->getUpgradeFile('3.5'));
                $this->setSystemCategories();
                $this->setSalesAdminPrivileges();
            case '3_6':
                $this->execSQL($this->getUpgradeFile('3.6'));
            case '3_7':
                $this->execSQL($this->getUpgradeFile('3.7'));
                $this->updateDocPrivileges();
                $this->moveDocContent();
                $this->addProjectDoc();
            case '4_0': 
                $this->addProjPrivilege(); 
            case '4_1': 
                $this->execSQL($this->getUpgradeFile('4.1'));
                $this->updateMakeupActions();
            case '4_2': 
                $this->execSQL($this->getUpgradeFile('4.2'));
            case '4_2_1': 
                $this->execSQL($this->getUpgradeFile('4.2.1'));
            case '4_2_2':
            case '4_2_3':
            case '4_3_beta': 
                $this->execSQL($this->getUpgradeFile('4.3.beta'));
            case '4_4': 
                $this->processContractAddress();
                $this->execSQL($this->getUpgradeFile('4.4'));
            case '4_5': 
                $this->execSQL($this->getUpgradeFile('4.5'));
                $this->renameLastCategory();
            case '4_6': 
                $this->execSQL($this->getUpgradeFile('4.6'));
                $this->upgradeProductLine();

            default: if(!$this->isError()) $this->loadModel('setting')->updateVersion($this->config->version);
        }

        $this->deletePatch();
    }

//**//
}