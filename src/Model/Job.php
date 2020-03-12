<?php
/**
 * Job.php - Job Entity
 *
 * Entity Model for Job
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

use Application\Model\CoreEntityModel;

class Job extends CoreEntityModel {
    public $label;
    public $payment_id;
    public $payment_received;
    public $payment_session_id;

    /**
     * Job constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @since 1.0.0
     */
    public function __construct($oDbAdapter) {
        parent::__construct($oDbAdapter);

        # Set Single Form Name
        $this->sSingleForm = 'job-single';

        # Attach Dynamic Fields to Entity Model
        $this->attachDynamicFields();
    }

    /**
     * Set Entity Data based on Data given
     *
     * @param array $aData
     * @since 1.0.0
     */
    public function exchangeArray(array $aData) {
        $this->id = !empty($aData['Job_ID']) ? $aData['Job_ID'] : 0;
        $this->label = !empty($aData['label']) ? $aData['label'] : '';
        $this->payment_id = !empty($aData['payment_id']) ? $aData['payment_id'] : '';
        $this->payment_received = !empty($aData['payment_received']) ? $aData['payment_received'] : '0000-00-00 00:00:00';
        $this->payment_session_id = !empty($aData['payment_session_id']) ? $aData['payment_session_id'] : '';

        $this->updateDynamicFields($aData);
    }
}