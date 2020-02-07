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
     * @return mixed
     * @since 1.0.0
     */
    public function getSingle($id) {
        # Use core function
        return $this->getSingleEntity($id,'Job_ID');
    }

    /**
     * Save Job Entity
     *
     * @param Job $oJob
     * @return int Job ID
     * @since 1.0.0
     */
    public function saveSingle(Job $oJob) {
        $aData = [
            'label' => $oJob->label,
        ];

        $aData = $this->attachDynamicFields($aData,$oJob);

        $id = (int) $oJob->id;

        if ($id === 0) {
            # Add Metadata
            $aData['created_by'] = CoreController::$oSession->oUser->getID();
            $aData['created_date'] = date('Y-m-d H:i:s',time());
            $aData['modified_by'] = CoreController::$oSession->oUser->getID();
            $aData['modified_date'] = date('Y-m-d H:i:s',time());

            # Insert Job
            $this->oTableGateway->insert($aData);

            # Return ID
            return $this->oTableGateway->lastInsertValue;
        }

        # Check if Job Entity already exists
        try {
            $this->getSingle($id);
        } catch (\RuntimeException $e) {
            throw new \RuntimeException(sprintf(
                'Cannot update job with identifier %d; does not exist',
                $id
            ));
        }

        # Update Metadata
        $aData['modified_by'] = CoreController::$oSession->oUser->getID();
        $aData['modified_date'] = date('Y-m-d H:i:s',time());

        # Update Job
        $this->oTableGateway->update($aData, ['Job_ID' => $id]);

        return $id;
    }

    /**
     * Generate new single Entity
     *
     * @return Job
     * @since 1.0.0
     */
    public function generateNew() {
        return new Job($this->oTableGateway->getAdapter());
    }
}