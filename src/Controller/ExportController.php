<?php
/**
 * ExportController.php - Job Export Controller
 *
 * Main Controller for Job Export
 *
 * @category Controller
 * @package Job
 * @author Verein onePlace
 * @copyright (C) 2020  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.3
 */

namespace OnePlace\Job\Controller;

use Application\Controller\CoreController;
use Application\Controller\CoreExportController;
use OnePlace\Job\Model\JobTable;
use Laminas\Db\Sql\Where;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\View\Model\ViewModel;


class ExportController extends CoreExportController
{
    /**
     * ApiController constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @param JobTable $oTableGateway
     * @since 1.0.0
     */
    public function __construct(AdapterInterface $oDbAdapter,JobTable $oTableGateway,$oServiceManager) {
        parent::__construct($oDbAdapter,$oTableGateway,$oServiceManager);
    }


    /**
     * Dump Jobs to excel file
     *
     * @return ViewModel
     * @since 1.0.3
     */
    public function dumpAction() {
        $this->layout('layout/json');

        # Use Default export function
        $aViewData = $this->exportData('Jobs','job');

        # return data to view (popup)
        return new ViewModel($aViewData);
    }
}