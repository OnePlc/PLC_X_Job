<?php
/**
 * JobTable.php - Job Table
 *
 * Table Model for Job
 *
 * @category Model
 * @package Job
 * @author Verein onePlace
 * @copyright (C) 2020 Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

namespace OnePlace\Job\Model;

use Application\Controller\CoreController;
use Application\Model\CoreEntityTable;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;
use Laminas\Paginator\Paginator;
use Laminas\Paginator\Adapter\DbSelect;

class JobTable extends CoreEntityTable {

    /**
     * JobTable constructor.
     *
     * @param TableGateway $tableGateway
     * @since 1.0.0
     */
    public function __construct(TableGateway $tableGateway) {
        parent::__construct($tableGateway);

        # Set Single Form Name
        $this->sSingleForm = 'job-single';
    }

    /**
     * Get Job Entity
     *
     * @param int $id
     * @param string $sKey
     * @return mixed
     * @since 1.0.0
     */
    public function getSingle($id,$sKey = 'Job_ID') {
        # Use core function
        return $this->getSingleEntity($id,$sKey);
    }

    /**
     * Save Job Entity
     *
     * @param Job $oJob
     * @return int Job ID
     * @since 1.0.0
     */
    public function saveSingle(Job $oJob) {
        $aDefaultData = [
            'label' => $oJob->label,
        ];

        return $this->saveSingleEntity($oJob,'Job_ID',$aDefaultData);
    }

    /**
     * Generate new single Entity
     *
     * @return Job
     * @since 1.0.3
     */
    public function generateNew() {
        return new Job($this->oTableGateway->getAdapter());
    }
}