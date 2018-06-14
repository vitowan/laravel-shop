<?php
/**
 * The control file of attend of Ranzhi.
 *
 * @copyright   Copyright 2009-2018 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      chujilu <chujilu@cnezsoft.com>
 * @package     attend
 * @version     $Id$
 * @link        http://www.ranzhi.org
 */
class attend extends control
{
    /**
     * personal 
     * 
     * @param  string $date 
     * @access public
     * @return void
     */
    public function personal($date = '')
    {
        if($date == '' or strlen($date) != 6) $date = date('Ym');
        $currentYear  = substr($date, 0, 4);
        $currentMonth = substr($date, 4, 2);
        $startDate    = "{$currentYear}-{$currentMonth}-01";
        $endDate      = date('Y-m-d', strtotime("$startDate +1 month"));
        $dayNum       = (int)date('d', strtotime("$endDate -1 day"));
        $weekNum      = (int)ceil($dayNum / 7);

        $attends   = $this->attend->getByAccount($this->app->user->account, $startDate, $endDate > helper::today() ? helper::today() : $endDate);
        $monthList = $this->attend->getAllMonth($type = 'personal');
        $yearList  = array_keys($monthList);

        $this->view->title        = $this->lang->attend->personal;
        $this->view->attends      = $attends;
        $this->view->dayNum       = $dayNum;
        $this->view->weekNum      = $weekNum;
        $this->view->currentYear  = $currentYear;
        $this->view->currentMonth = $currentMonth;
        $this->view->yearList     = $yearList;
        $this->view->monthList    = $monthList;
        $this->display();
    }

    /**
     * department's attend. 
     * 
     * @param  string $date 
     * @access public
     * @return void
     */
    public function department($date = '')
    {
        die($this->fetch('attend', 'browse', "date=$date", 'oa'));
    }

    /**
     * company's attend. 
     * 
     * @param  string $date 
     * @access public
     * @return void
     */
    public function company($date = '')
    {
        die($this->fetch('attend', 'browse', "date=$date&company=true", 'oa'));
    }

    /**
     * Browse attend. 
     * 
     * @param  string $date 
     * @param  bool   $company 
     * @access public
     * @return void
     */
    public function browse($date = '', $company = false)
    {
        if($date == '' or strlen($date) != 6) $date = date('Ym');
        $currentYear  = substr($date, 0, 4);
        $currentMonth = substr($date, 4, 2);
        $startDate    = "{$currentYear}-{$currentMonth}-01";
        $endDate      = date('Y-m-d', strtotime("$startDate +1 month"));

        $dayNum    = (int)date('d', strtotime("$endDate -1 day"));
        $weekNum   = (int)ceil($dayNum / 7);
        $monthList = $this->attend->getAllMonth($type = $company ? 'company' : 'department');
        $yearList  = array_keys($monthList);

        /* Get deptList. */
        if($company) 
        {
            $deptList = $this->loadModel('tree')->getPairs('', 'dept');
            $deptList[0] = '/';
        }
        else
        {
            $deptList = array();
            $depts    = $this->loadModel('tree')->getListByType('dept');
            foreach($depts as $dept)
            {
                if($dept->moderators != ",{$this->app->user->account},") continue;

                /* Get family of current dept. */
                foreach($depts as $d)
                {
                    if(strpos($d->path, $dept->path) === 0) $deptList[$d->id] = $d->name;
                }
            }
        }

        /* Get attend. */
        $attends = array();
        if(!empty($deptList)) 
        {
            $dept = array_keys($deptList);
            $attends = $this->attend->getByDept($dept, $startDate, $endDate < helper::today() ? $endDate : helper::today());
        }

        $users    = $this->loadModel('user')->getList();
        $newUsers = array();
        foreach($users as $key => $user) $newUsers[$user->account] = $user;

        $this->view->title        = $this->lang->attend->department;
        $this->view->attends      = $attends;
        $this->view->dayNum       = $dayNum;
        $this->view->weekNum      = $weekNum;
        $this->view->currentYear  = $currentYear;
        $this->view->currentMonth = $currentMonth;
        $this->view->yearList     = $yearList;
        $this->view->monthList    = $monthList;
        $this->view->deptList     = $deptList;
        $this->view->users        = $newUsers;
        $this->view->company      = $company;
        $this->display();
    }

    /**
     * Export attend data.
     * 
     * @param  string $date 
     * @param  bool   $company 
     * @access public
     * @return void
     */
    public function export($date = '', $company = false)
    {
        if($date == '' or strlen($date) != 6) $date = date('Ym');
        $currentYear  = substr($date, 0, 4);
        $currentMonth = substr($date, 4, 2);
        $startDate    = "{$currentYear}-{$currentMonth}-01";
        $endDate      = date('Y-m-d', strtotime("$startDate +1 month"));
        $dayNum       = (int)date('d', strtotime("$endDate -1 day"));

        if($_POST)
        {
            /* Get deptList. */
            if($company) 
            {
                $deptList = $this->loadModel('tree')->getPairs('', 'dept');
                $deptList[0] = '/';
            }
            else
            {
                $deptList = $this->loadModel('tree')->getDeptManagedByMe($this->app->user->account);
                foreach($deptList as $key => $value) $deptList[$key] = $value->name;
            }

            /* Get attend. */
            $attends = array();
            if(!empty($deptList)) 
            {
                $dept = array_keys($deptList);
                $attends = $this->attend->getByDept($dept, $startDate, $endDate < helper::today() ? $endDate : helper::today());
            }

            $users    = $this->loadModel('user')->getList();
            $tmpUsers = array();
            foreach($users as $key => $user) $tmpUsers[$user->account] = $user;
            $users = $tmpUsers;

            /* Get fields. */
            $this->app->loadLang('user');
            $fields['dept']     = $this->lang->user->dept;
            $fields['realname'] = $this->lang->user->realname;
            for($i = 1; $i <= $dayNum; $i++)
            {
                $currentDate  = date("Y-m-d", strtotime("$currentYear-$currentMonth-$i"));
                $fields[$currentDate] = $i;
            }

            /* Get dayname */
            $datas = array();
            $data  = new stdclass();
            $data->dept     = '';
            $data->realname = '';
            for($i = 1; $i <= $dayNum; $i++)
            {
                $currentDate  = date("Y-m-d", strtotime("$currentYear-$currentMonth-$i"));
                $dayNameIndex = date('w', strtotime($currentDate));
                $data->$currentDate = $this->lang->datepicker->abbrDayNames[$dayNameIndex];
            }
            $datas[] = $data;

            /* Get row data. */
            foreach($attends as $dept => $deptAttendList)
            {
                foreach($deptAttendList as $account => $attendList)
                {
                    $data = new stdclass();
                    $data->dept     = $deptList[$users[$account]->dept];
                    $data->realname = $users[$account]->realname;
                    for($i = 1; $i <= $dayNum; $i++)
                    {
                        $currentDate  = date("Y-m-d", strtotime("$currentYear-$currentMonth-$i"));
                        $data->$currentDate = isset($attendList[$currentDate]) ? zget($this->lang->attend->markStatusList, $attendList[$currentDate]->status) : '';
                    }
                    $datas[] = $data;
                }
            }

            /* Get legend. */
            if(!empty($datas))
            {
                $data = new stdclass();
                $data->dept = '';
                $datas[] = $data;

                $legend = array();
                foreach($this->lang->attend->markStatusList as $key => $value)
                {
                    $data = new stdclass();
                    $data->dept = $value;
                    $data->realname = $this->lang->attend->statusList[$key];
                    $datas[] = $data;
                }
            }

            $this->post->set('fields', $fields);
            $this->post->set('rows', $datas);
            $this->post->set('kind', 'attendance');
            $this->fetch('file', 'export2CSV', $_POST);
        }

        $this->view->fileName = $currentYear . $this->lang->year . $currentMonth . $this->lang->month . $this->lang->attend->report;
        $this->display();
    }

    /**
     * Sign in. 
     * 
     * @access public
     * @return void
     */
    public function signIn()
    {
        $result = $this->attend->signIn();
        if(is_array($result)) $this->send($result);

        if(!$result) $this->send(array('result' => 'fail', 'message' => $this->lang->attend->inFail));
        $this->send(array('result' => 'success', 'message' => $this->lang->attend->inSuccess));
    }

    /**
     * Sign out. 
     * 
     * @access public
     * @return void
     */
    public function signOut()
    {
        $result  = $this->attend->signOut();
        if(!$result) $this->send(array('result' => 'fail', 'message' => $this->lang->attend->outFail));
        $this->send(array('result' => 'success', 'message' => $this->lang->attend->outSuccess));
    }

    /**
     * settings 
     * 
     * @param  string $module
     * @access public
     * @return void
     */
    public function settings($module = '')
    {
        if($_POST)
        {
            $settings = fixer::input('post')
                ->setDefault('mustSignOut', 'no')
                ->setDefault('ip', '*')
                ->setIF($this->post->allip, 'ip', '*')
                ->setIF(!$this->post->noAttendUsers, 'noAttendUsers', '')
                ->join('mustSignOut', '')
                ->join('noAttendUsers', ',')
                ->remove('allip')
                ->get();

            $settings->signInLimit  = date("H:i", strtotime($settings->signInLimit));
            $settings->signOutLimit = date("H:i", strtotime($settings->signOutLimit));
            $this->loadModel('setting')->setItems('system.oa.attend', $settings);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => 'reload'));
        }

        if($module)
        {
            $this->lang->menuGroups->attend = $module;
            $this->lang->attend->menu       = $this->lang->$module->menu;
        }

        $this->loadModel('user');
        $this->view->title          = $this->lang->attend->settings; 
        $this->view->beginDate      = $this->config->attend->beginDate->company;
        $this->view->signInLimit    = $this->config->attend->signInLimit;
        $this->view->signOutLimit   = $this->config->attend->signOutLimit;
        $this->view->workingDays    = $this->config->attend->workingDays;
        $this->view->workingHours   = $this->config->attend->workingHours;
        $this->view->mustSignOut    = $this->config->attend->mustSignOut;
        $this->view->noAttendUsers  = $this->config->attend->noAttendUsers;
        $this->view->ip             = $this->config->attend->ip;
        $this->view->reviewedBy     = isset($this->config->attend->reviewedBy) ? $this->config->attend->reviewedBy : '';
        $this->view->users          = $this->user->getPairs('noempty,noclosed,nodeleted,noforbidden');
        $this->view->module         = $module;
        $this->display();
    }

    /**
     * add manual sign in and sign out data. 
     * 
     * @param  string $date 
     * @access public
     * @return void
     */
    public function edit($date = '')
    {
        if(!$date) $date = date('Y-m-d');

        $account = $this->app->user->account;
        $attend  = $this->attend->getByDate($date, $account);

        if($_POST)
        {
            $result = $this->attend->update($attend, $date, $account);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));

            if(isset($attend->new)) 
            {
                $attendID = $result;
                $actionID = $this->loadModel('action')->create('attend', $attendID, 'commited');
                $this->sendmail($attendID, $actionID);
            }
            else
            {
                $attendID = $attend->id;
                $changes  = $result;
                if($changes)
                {
                    $actionID = $this->loadModel('action')->create('attend', $attendID, 'commited');
                    $this->action->logHistory($actionID, $changes);
                    $this->sendmail($attendID, $actionID);
                }
            }

            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('personal')));
        }

        $this->view->title  = $this->lang->attend->edit;
        $this->view->attend = $attend;
        $this->view->date   = $date;
        $this->display();
    }

    /**
     * browse review list.
     * 
     * @param  int    $dept 
     * @access public
     * @return void
     */
    public function browseReview($dept = '')
    {
        $attends  = array();
        $deptList = array();
        /* Get deptments managed by me. */
        if(!empty($this->config->attend->reviewedBy))
        { 
            if(($this->app->user->admin == 'super') or ($this->config->attend->reviewedBy == $this->app->user->account))
            {
                $deptList = $this->loadModel('tree')->getPairs('', 'dept');
                $deptList['0'] = '/';
            }
        }
        else
        {
            $depts = $this->loadModel('tree')->getDeptManagedByMe($this->app->user->account);
            foreach($depts as $d) $deptList[$d->id] = $d->name;
        }
        if(!empty($deptList)) $attends = $this->attend->getWaitAttends(array_keys($deptList));

        /* Get users info. */
        $users    = $this->loadModel('user')->getList($dept);
        $newUsers = array();
        foreach($users as $key => $user) $newUsers[$user->account] = $user;

        $this->view->title    = $this->lang->attend->review;
        $this->view->users    = $newUsers;
        $this->view->attends  = $attends;
        $this->view->deptList = $deptList;
        $this->display();
    }

    /**
     * Review manual sign data. 
     * 
     * @param  int    $attendID 
     * @param  string $reviewStatus 
     * @access public
     * @return void
     */
    public function review($attendID, $reviewStatus)
    {
        if($reviewStatus == 'pass')
        {
            $this->attend->review($attendID, $reviewStatus);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $actionID = $this->loadModel('action')->create('attend', $attendID, 'reviewed', '', $this->lang->attend->reviewStatusList[$reviewStatus]);
            $this->sendmail($attendID, $actionID);
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess));
        }

        if($reviewStatus == 'reject')
        {
            if($_POST)
            {
                if(!$this->post->comment) $this->send(array('result' => 'fail', 'message' => array('comment' => sprintf($this->lang->error->notempty, $this->lang->attend->rejectReason))));

                $this->attend->review($attendID, $reviewStatus);
                if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));

                $actionID = $this->loadModel('action')->create('attend', $attendID, 'reviewed', $this->post->comment, $this->lang->attend->reviewStatusList[$reviewStatus]);
                $this->sendmail($attendID, $actionID);
                $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => 'reload'));
            }

            $this->view->title    = $this->lang->attend->review;
            $this->view->attendID = $attendID;
            $this->display();
        }
    }

    /**
     * Send email.
     * 
     * @param  int    $attendID 
     * @param  int    $actionID 
     * @access public
     * @return void
     */
    public function sendmail($attendID, $actionID)
    {
        /* Reset $this->output. */
        $this->clear();

        /* Get action info. */
        $action          = $this->loadModel('action')->getById($actionID);
        $history         = $this->action->getHistory($actionID);
        $action->history = isset($history[$actionID]) ? $history[$actionID] : array();

        /* Set toList. */
        $attend  = $this->attend->getById($attendID);
        $users   = $this->loadModel('user')->getPairs();
        $toList  = $attend->account;
        if($action->action == 'commited')
        {
            if(!empty($this->config->attend->reviewedBy))
            {
                $toList = $this->config->attend->reviewedBy; 
            }
            else
            {
               $dept = $this->loadModel('tree')->getByID($this->app->user->dept);
               if(!empty($dept->moderators)) $toList = trim($dept->moderators, ','); 
            }
        }
        $label = '';
        if($action->action == 'commited') $label = $this->lang->attend->edit;
        if($action->action == 'reviewed') $label = $this->lang->attend->review;
        $subject = "{$this->lang->attend->common} - $label#" . zget($users, $attend->account);

        /* send notice if user is online and return failed accounts. */
        $toList = $this->loadModel('action')->sendNotice($actionID, $toList);

        /* Create the email content. */
        $this->view->attend = $attend;
        $this->view->action = $action;
        $this->view->users  = $users;
        $this->view->label  = $label;

        $mailContent = $this->parse($this->moduleName, 'sendmail');

        /* Send emails. */
        $this->loadModel('mail')->send($toList, $subject, $mailContent);
        if($this->mail->isError()) trigger_error(join("\n", $this->mail->getError()));
    }

    /**
     * Set a date to begin record attend status. 
     * 
     * @param  string $module 
     * @access public
     * @return void
     */
    public function personalSettings($module = '')
    {
        if($_POST)
        {
            $this->attend->savePersonalSettings();
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => 'reload'));
        }

        if($module)
        {
            $this->lang->menuGroups->attend = $module;
            $this->lang->attend->menu       = $this->lang->$module->menu;
        }

        $this->view->title  = $this->lang->attend->personalSettings;
        $this->view->users  = $this->loadModel('user', 'sys')->getPairs('noclosed,nodeleted,noforbidden');
        $this->view->module = $module;
        $this->display();
    }

    /**
     * Set reviewer for attend.
     * 
     * @param  string $module
     * @access public
     * @return void
     */
    public function setManager($module = '')
    {
        if($_POST)
        {
            $this->attend->setManager();
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => 'reload'));
        }

        if($module)
        {
            $this->lang->menuGroups->attend = $module;
            $this->lang->attend->menu       = $this->lang->$module->menu;
        }

        $this->view->title    = $this->lang->attend->setManager;
        $this->view->deptList = $this->loadModel('tree')->getListByType('dept');
        $this->view->users    = $this->loadModel('user')->getPairs('noclosed,nodeleted,noforbidden');
        $this->view->module   = $module;
        $this->display();
    }

    /**
     * Browse stat of attend.
     * 
     * @param  string  $month
     * @param  string  $mode 
     * @access public
     * @return void
     */
    public function stat($month = '', $mode = '')
    {
        if(!$month or (strlen($month) != 4 && strlen($month) != 6)) $month = date('Ym');
        $currentYear  = substr($month, 0, 4);
        $currentMonth = substr($month, 4, 2);
        $users        = $this->loadModel('user')->getPairs('noclosed,noempty,nodeleted,noforbidden');

        $stat = $this->attend->getStat($month);
        if(!empty($stat))
        {
            $mode = $mode ? $mode : 'view';
            $this->app->loadLang('leave');
            $this->app->loadLang('overtime');
        }
        else
        {
            $mode = 'edit';
            
            $stat = $this->attend->computeStat($currentYear, $currentMonth, $users);
        }

        $monthList = $this->attend->getAllMonth($type = 'stat');
        $yearList  = array_keys($monthList);

        $this->view->title        = $this->lang->attend->stat;
        $this->view->waitReviews  = $this->attend->checkWaitReviews($month);
        $this->view->mode         = $mode;
        $this->view->stat         = $stat;
        $this->view->month        = $month;
        $this->view->currentYear  = $currentYear;
        $this->view->currentMonth = $currentMonth;
        $this->view->yearList     = $yearList;
        $this->view->monthList    = $monthList;
        $this->view->users        = $users;
        $this->display();
    }

    /**
     * Save stat for attend.
     * 
     * @param  string    $date 
     * @access public
     * @return void
     */
    public function saveStat($date)
    {
        if($_POST)
        {
            $this->attend->saveStat($date);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('stat', "date=$date")));
        }
    }

    /**
     * Export attend stat.
     * 
     * @param  string   $date 
     * @access public
     * @return void
     */
    public function exportStat($date = '')
    {
        if($date == '' or strlen($date) != 6) $date = date('Ym', strtotime('last month'));
        $currentYear  = substr($date, 0, 4);
        $currentMonth = substr($date, 4, 2);

        if($_POST)
        {
            $statList = $this->attend->getStat($date);
            $users    = $this->loadModel('user')->getPairs();
            $this->app->loadLang('leave');
            $this->app->loadLang('overtime');

            /* Get fields. */
            $fields['realname']        = $this->lang->user->realname;
            $fields['normal']          = $this->lang->attend->statusList['normal'];
            $fields['late']            = $this->lang->attend->statusList['late'];
            $fields['early']           = $this->lang->attend->statusList['early'];
            $fields['absent']          = $this->lang->attend->statusList['absent'];
            $fields['trip']            = $this->lang->attend->statusList['trip'];
            $fields['egress']          = $this->lang->attend->statusList['egress'];
            $fields['paidLeave']       = $this->lang->leave->paid;
            $fields['unpaidLeave']     = $this->lang->leave->unpaid;
            $fields['timeOvertime']    = $this->lang->overtime->typeList['time'];
            $fields['restOvertime']    = $this->lang->overtime->typeList['rest'];
            $fields['holidayOvertime'] = $this->lang->overtime->typeList['holiday'];
            $fields['deserve']         = $this->lang->attend->deserveDays;
            $fields['actual']          = $this->lang->attend->actualDays;

            $datas = array();
            foreach($statList as $account => $stat)
            {
                $data = new stdclass();
                $data->realname        = $users[$account];
                $data->normal          = $stat->normal;
                $data->late            = $stat->late;
                $data->early           = $stat->early;
                $data->absent          = $stat->absent;
                $data->trip            = $stat->trip;
                $data->egress          = $stat->egress;
                $data->paidLeave       = $stat->paidLeave;
                $data->unpaidLeave     = $stat->unpaidLeave;
                $data->timeOvertime    = $stat->timeOvertime;
                $data->restOvertime    = $stat->restOvertime;
                $data->holidayOvertime = $stat->holidayOvertime;
                $data->deserve         = $stat->deserve;
                $data->actual          = $stat->actual;

                $datas[] = $data;
            }

            $this->post->set('fields', $fields);
            $this->post->set('rows', $datas);
            $this->post->set('kind', 'attendstat');
            $this->fetch('file', 'export2CSV', $_POST);
        }

        $this->view->fileName = $currentYear . $this->lang->year . $currentMonth . $this->lang->month . $this->lang->attend->report;
        $this->display();
    }

    /**
     * Show detail attends. 
     * 
     * @param  string $date 
     * @param  int    $dept 
     * @param  string $account 
     * @access public
     * @return void
     */
    public function detail($date = '', $deptID = 0, $account = '')
    {
        if($_POST)
        {
            $deptID  = $this->post->dept;
            $account = $this->post->account;
            $date    = str_replace('-', '', $this->post->date);
        }

        if($date == '' or strlen($date) != 6) $date = date('Ym');
        $currentYear  = substr($date, 0, 4);
        $currentMonth = substr($date, 4, 2);

        $deptList = array('') + $this->loadModel('tree')->getPairs(0, 'dept');
        $userList = $this->loadModel('user')->getPairs('noclosed,nodeleted,noforbidden', $deptID);

        /* Sort data. */
        if(function_exists('iconv'))
        {
            $clientLang = $this->app->getClientLang();
            if($clientLang == 'zh-cn')
            {
                foreach($deptList as $key => $value) $deptList[$key] = @iconv('UTF-8', 'GBK', $value);
                foreach($userList as $key => $value) $userList[$key] = @iconv('UTF-8', 'GBK', $value);
            }
            elseif($clientLang == 'zh-tw')
            {
                foreach($deptList as $key => $value) $deptList[$key] = @iconv('UTF-8', 'BIG5', $value);
                foreach($userList as $key => $value) $userList[$key] = @iconv('UTF-8', 'BIG5', $value);
            }
        }
        
        asort($deptList);
        asort($userList);
        
        if(function_exists('iconv'))
        {
            if($clientLang == 'zh-cn')
            {
                foreach($deptList as $key => $value) $deptList[$key] = @iconv('GBK', 'UTF-8', $value);
                foreach($userList as $key => $value) $userList[$key] = @iconv('GBK', 'UTF-8', $value);
            }                                                                                
            elseif($clientLang == 'zh-tw')                                                   
            {                                                                                
                foreach($deptList as $key => $value) $deptList[$key] = @iconv('BIG5','UTF-8',  $value);
                foreach($userList as $key => $value) $userList[$key] = @iconv('BIG5','UTF-8',  $value);
            }
        }

        $attends = $this->attend->getDetailAttends($date, $account, $deptID);

        $this->session->set('attendDeptID', $deptID);
        $this->session->set('attendAccount', $account);

        $fileName = ''; 
        if($deptID)
        {
            $dept = zget($deptList, $deptID, '');
            if($dept) $fileName .= $dept . ' - ';
        }
        if($account) 
        {
            $user = zget($userList, $account, '');
            if($user) $fileName .= $user . ' - ';
        }
        $fileName .= $currentYear . $this->lang->year . $currentMonth . $this->lang->month . $this->lang->attend->detail;

        $this->view->title        = $this->lang->attend->detail;
        $this->view->dept         = $deptID;
        $this->view->account      = $account;
        $this->view->date         = "{$currentYear}-{$currentMonth}-01";
        $this->view->currentYear  = $currentYear;
        $this->view->currentMonth = $currentMonth;
        $this->view->deptList     = $deptList;
        $this->view->userList     = $userList;
        $this->view->attends      = $attends;
        $this->view->fileName     = $fileName;
        $this->display();
    }

    /**
     * Get dept users by ajax. 
     * 
     * @param  int    $deptID
     * @access public
     * @return void
     */
    public function ajaxGetDeptUsers($deptID = 0)
    {
        $users = $this->loadModel('user')->getPairs('noclosed,nodeleted,noforbidden', $deptID);
        $html  = '';
        foreach($users as $account => $name)
        {
            $html .= "<option value='{$account}'>$name</option>";
        }
        echo $html;
    }

    /**
     * Export detail attends.
     * 
     * @param  string $date 
     * @param  bool   $company 
     * @access public
     * @return void
     */
    public function exportDetail($date = '')
    {
        if($date == '' or strlen($date) != 6) $date = date('Ym');
        $currentYear  = substr($date, 0, 4);
        $currentMonth = substr($date, 4, 2);
        $deptID       = isset($_SESSION['attendDeptID'])  ? $_SESSION['attendDeptID']  : 0;
        $account      = isset($_SESSION['attendAccount']) ? $_SESSION['attendAccount'] : '';

        if($_POST)
        {
            /* Get fields. */
            $fields = explode(',', $this->config->attend->list->exportFields);
            foreach($fields as $key => $field)
            {
                $field = trim($field);
                $fields[$field] = isset($this->lang->attend->$field) ? $this->lang->attend->$field : '';
                unset($fields[$key]);
            }
            $fields['dept']     = $this->lang->user->dept;
            $fields['realname'] = $this->lang->user->realname;

            $attends = $this->attend->getDetailAttends($date, $account, $deptID);

            $this->post->set('fields', $fields);
            $this->post->set('rows', $attends);
            $this->fetch('file', 'export2CSV', $_POST);
        }

        $fileName = ''; 
        if($deptID)
        {
            $dept = $this->loadModel('tree')->getById($deptID, $type = 'dept');
            if($dept) $fileName .= $dept->name . ' - ';
        }
        if($account) 
        {
            $user = $this->loadModel('user')->getByAccount($account);
            if($user) $fileName .= $user->realname . ' - ';
        }
        $fileName .= $currentYear . $this->lang->year . $currentMonth . $this->lang->month . $this->lang->attend->detail;

        $this->view->fileName = $fileName;
        $this->display('attend', 'export');
    }

    /**
     * Read attend notice.
     * 
     * @access public
     * @return void
     */
    public function read()
    {
        $today = helper::today();
        if(!isset($this->config->attend->readers->$today)) $this->loadModel('setting')->deleteItems("owner=system&app=oa&module=attend&section=readers");

        $readers = isset($this->config->attend->readers->$today) ? $this->config->attend->readers->$today . ',' . $this->app->user->account : $this->app->user->account;
        $this->loadModel('setting')->setItem("system.oa.attend.readers.{$today}", $readers);
    }
}
