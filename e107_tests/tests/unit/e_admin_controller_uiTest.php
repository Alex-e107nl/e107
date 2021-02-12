<?php
	/**
	 * e107 website system
	 *
	 * Copyright (C) 2008-2020 e107 Inc (e107.org)
	 * Released under the terms and conditions of the
	 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
	 *
	 */


	class e_admin_controller_uiTest extends \Codeception\Test\Unit
	{

		/** @var e_admin_controller_ui */
		protected $ui;

		protected function _before()
		{

			try
			{
				$this->ui = $this->make('e_admin_controller_ui');
			}
			catch(Exception $e)
			{
				$this->assertTrue(false, "Couldn't load e_admin_controller_ui object");
			}

		}

		public function testJoinAlias()
		{
			// Simple Join --------------
			$qry = "SELECT u.*, ue.* FROM #user AS u LEFT JOIN #user_extended as ue on u.user_id = ue.user_extended_id";
			$this->ui->joinAlias($qry);

			$actual = $this->ui->getJoinAlias();
			$expected = array (  'user' => 'u',  'user_extended' => 'ue',);
			$this->assertEquals($expected,$actual);

			$actual = $this->ui->getJoinField();
			$expected = array (   'user_id' => 'u.user_id',   'user_extended_id' => 'ue.user_extended_id', );
			$this->assertEquals($expected,$actual);

			// Complex Join

			$qry2 = "SELECT e.*,m.mem_id, m.mem_firstname, m.mem_lastname, cl.cal_appointment_start FROM `#calls` AS e 
			LEFT JOIN `#member` as m ON 
			(
				e.calls_direction = 'Inbound' AND m.mem_status NOT LIKE '%DUP%' AND e.calls_from !='' AND 
				(
					e.calls_from = REPLACE(m.mem_phone_day, '-', '') 
					OR e.calls_from = REPLACE(m.mem_phone_night, '-', '')  
					OR e.calls_from = REPLACE(m.mem_phone_cell , '-', '') 
					OR e.calls_from = REPLACE(m.mem_phone_other1 , '-', '') 
					OR e.calls_from = REPLACE(m.mem_phone_other2 , '-', '')
				)
			
			) 
			LEFT JOIN `#member_calender` AS cl ON 
			(
				e.calls_direction = 'Outbound' AND 
				(
					cl.cal_by_phone = REPLACE(m.mem_phone_day, '-', '') 
					OR cl.cal_by_cell = REPLACE(m.mem_phone_cell , '-', '') 
				)
			
			) ";

			$this->ui->joinAlias($qry2);

			$actual = $this->ui->getJoinAlias();
			$expected = array ( 'user' => 'u',  'user_extended' => 'ue',  'calls' => 'e',  'member' => 'm', 'member_calender' => 'cl', );
			$this->assertEquals($expected,$actual);


			$actual = $this->ui->getJoinField();
			$expected = array (
			  'user_id' => 'u.user_id',
			  'user_extended_id' => 'ue.user_extended_id',
			  'calls_direction' => 'e.calls_direction',
			  'calls_from' => 'e.calls_from',
			  'mem_id' => 'm.mem_id',
			  'mem_firstname' => 'm.mem_firstname',
			  'mem_lastname' => 'm.mem_lastname',
			  'mem_status' => 'm.mem_status',
			  'mem_phone_day' => 'm.mem_phone_day',
			  'mem_phone_night' => 'm.mem_phone_night',
			  'mem_phone_cell' => 'm.mem_phone_cell',
			  'mem_phone_other1' => 'm.mem_phone_other1',
			  'mem_phone_other2' => 'm.mem_phone_other2',
			  'cal_appointment_start' => 'cl.cal_appointment_start',
			  'cal_by_phone' => 'cl.cal_by_phone',
			  'cal_by_cell' => 'cl.cal_by_cell',
			);

			$this->assertEquals($expected,$actual);

		}


/*
		public function testGetSortParent()
		{

		}

		public function testGetFieldPref()
		{

		}

		public function testGetTreeModelSorted()
		{

		}

		public function testManageColumns()
		{

		}

		public function testGetJoinField()
		{

		}

		public function testGetBatchFeaturebox()
		{

		}

		public function testSetModel()
		{

		}

		public function testGetTableFromAlias()
		{

		}

		public function testGetFieldAttr()
		{

		}

		public function testSetJoinData()
		{

		}

		public function testGetPrimaryName()
		{

		}

		public function testGetTableName()
		{

		}

		public function testGetUrl()
		{

		}

		public function testGetParentChildQry()
		{

		}

		public function testSetListModel()
		{

		}

		public function testGetPerPage()
		{

		}

		public function testGetSortField()
		{

		}

		public function testGetUserPref()
		{

		}

		public function testGetFormQuery()
		{

		}

		public function testGetBatchCopy()
		{

		}

		public function testGetTabs()
		{

		}

		public function testSetBatchDelete()
		{

		}

		public function testGetTreePrefix()
		{

		}

		public function testGetPrefs()
		{

		}

		public function testGetConfig()
		{

		}

		public function testGetBatchExport()
		{

		}

		public function testGetFieldVar()
		{

		}

		public function testSetFieldAttr()
		{

		}

		public function testSetTreeModel()
		{

		}

		public function testGetEventTriggerName()
		{

		}

		public function testGetBatchDelete()
		{

		}

		public function testGetAfterSubmitOptions()
		{

		}

		public function testGetValidationRules()
		{

		}

		public function testGetPrefTabs()
		{

		}

		public function testGetDefaultOrder()
		{

		}

		public function testGetModel()
		{

		}

		public function testSetBatchCopy()
		{

		}

		public function testGetEventName()
		{

		}

		public function testGetFields()
		{

		}

		public function testAddTab()
		{

		}

		public function testGetTreeModel()
		{

		}

		public function testGetPluginName()
		{

		}

		public function testGetPluginTitle()
		{

		}

		public function testGetUI()
		{

		}

		public function testParentChildSort_r()
		{

		}

		public function testGetGrid()
		{

		}

		public function testSetUI()
		{

		}

		public function testGetJoinData()
		{

		}

		public function testGetBatchLink()
		{

		}

		public function testGetDefaultOrderField()
		{

		}

		public function testGetFeaturebox()
		{

		}

		public function testGetIfTableAlias()
		{

		}

		public function testGetDataFields()
		{

		}

		public function testGetListModel()
		{

		}

		public function testGetBatchOptions()
		{

		}

		public function testSetUserPref()
		{

		}

		public function testSetConfig()
		{

		}

	*/


	}
