<?php
/**
 * JobController.php - Main Controller
 *
 * Main Controller Job Module
 *
 * @category Controller
 * @package Job
 * @author Verein onePlace
 * @copyright (C) 2020  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

declare(strict_types=1);

namespace OnePlace\Job\Controller;

use Application\Controller\CoreController;
use Application\Model\CoreEntityModel;
use OnePlace\Job\Model\Job;
use OnePlace\Job\Model\JobTable;
use Laminas\View\Model\ViewModel;
use Laminas\Db\Adapter\AdapterInterface;

class JobController extends CoreController {
    /**
     * Job Table Object
     *
     * @since 1.0.0
     */
    private $oTableGateway;

    /**
     * JobController constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @param JobTable $oTableGateway
     * @since 1.0.0
     */
    public function __construct(AdapterInterface $oDbAdapter,JobTable $oTableGateway,$oServiceManager) {
        $this->oTableGateway = $oTableGateway;
        $this->sSingleForm = 'job-single';
        parent::__construct($oDbAdapter,$oTableGateway,$oServiceManager);

        if($oTableGateway) {
            # Attach TableGateway to Entity Models
            if(!isset(CoreEntityModel::$aEntityTables[$this->sSingleForm])) {
                CoreEntityModel::$aEntityTables[$this->sSingleForm] = $oTableGateway;
            }
        }
    }

    /**
     * Job Index
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function indexAction() {
        # Set Layout based on users theme
        $this->setThemeBasedLayout('job');

        # Add Buttons for breadcrumb
        $this->setViewButtons('job-index');

        # Set Table Rows for Index
        $this->setIndexColumns('job-index');

        # Get Paginator
        $oPaginator = $this->oTableGateway->fetchAll(true);
        $iPage = (int) $this->params()->fromQuery('page', 1);
        $iPage = ($iPage < 1) ? 1 : $iPage;
        $oPaginator->setCurrentPageNumber($iPage);
        $oPaginator->setItemCountPerPage(3);

        # Log Performance in DB
        $aMeasureEnd = getrusage();
        $this->logPerfomance('job-index',$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"utime"),$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"stime"));

        return new ViewModel([
            'sTableName'=>'job-index',
            'aItems'=>$oPaginator,
        ]);
    }

    /**
     * Job Add Form
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function addAction() {
        # Set Layout based on users theme
        $this->setThemeBasedLayout('job');

        # Get Request to decide wether to save or display form
        $oRequest = $this->getRequest();

        # Display Add Form
        if(!$oRequest->isPost()) {
            # Add Buttons for breadcrumb
            $this->setViewButtons('job-single');

            # Load Tabs for View Form
            $this->setViewTabs($this->sSingleForm);

            # Load Fields for View Form
            $this->setFormFields($this->sSingleForm);

            # Log Performance in DB
            $aMeasureEnd = getrusage();
            $this->logPerfomance('job-add',$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"utime"),$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"stime"));

            return new ViewModel([
                'sFormName' => $this->sSingleForm,
            ]);
        }

        # Get and validate Form Data
        $aFormData = $this->parseFormData($_REQUEST);

        # Save Add Form
        $oJob = new Job($this->oDbAdapter);
        $oJob->exchangeArray($aFormData);
        $iJobID = $this->oTableGateway->saveSingle($oJob);
        $oJob = $this->oTableGateway->getSingle($iJobID);

        # Save Multiselect
        $this->updateMultiSelectFields($_REQUEST,$oJob,'job-single');

        # Log Performance in DB
        $aMeasureEnd = getrusage();
        $this->logPerfomance('job-save',$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"utime"),$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"stime"));

        # Display Success Message and View New Job
        $this->flashMessenger()->addSuccessMessage('Job successfully created');
        return $this->redirect()->toRoute('job',['action'=>'view','id'=>$iJobID]);
    }

    /**
     * Job Edit Form
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function editAction() {
        # Set Layout based on users theme
        $this->setThemeBasedLayout('job');

        # Get Request to decide wether to save or display form
        $oRequest = $this->getRequest();

        # Display Edit Form
        if(!$oRequest->isPost()) {

            # Get Job ID from URL
            $iJobID = $this->params()->fromRoute('id', 0);

            # Try to get Job
            try {
                $oJob = $this->oTableGateway->getSingle($iJobID);
            } catch (\RuntimeException $e) {
                echo 'Job Not found';
                return false;
            }

            # Attach Job Entity to Layout
            $this->setViewEntity($oJob);

            # Add Buttons for breadcrumb
            $this->setViewButtons('job-single');

            # Load Tabs for View Form
            $this->setViewTabs($this->sSingleForm);

            # Load Fields for View Form
            $this->setFormFields($this->sSingleForm);

            # Log Performance in DB
            $aMeasureEnd = getrusage();
            $this->logPerfomance('job-edit',$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"utime"),$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"stime"));

            return new ViewModel([
                'sFormName' => $this->sSingleForm,
                'oJob' => $oJob,
            ]);
        }

        $iJobID = $oRequest->getPost('Item_ID');
        $oJob = $this->oTableGateway->getSingle($iJobID);

        # Update Job with Form Data
        $oJob = $this->attachFormData($_REQUEST,$oJob);

        # Save Job
        $iJobID = $this->oTableGateway->saveSingle($oJob);

        $this->layout('layout/json');

        # Save Multiselect
        $this->updateMultiSelectFields($_REQUEST,$oJob,'job-single');

        # Log Performance in DB
        $aMeasureEnd = getrusage();
        $this->logPerfomance('job-save',$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"utime"),$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"stime"));

        # Display Success Message and View New User
        $this->flashMessenger()->addSuccessMessage('Job successfully saved');
        return $this->redirect()->toRoute('job',['action'=>'view','id'=>$iJobID]);
    }

    /**
     * Job View Form
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function viewAction() {
        # Set Layout based on users theme
        $this->setThemeBasedLayout('job');

        # Get Job ID from URL
        $iJobID = $this->params()->fromRoute('id', 0);

        # Try to get Job
        try {
            $oJob = $this->oTableGateway->getSingle($iJobID);
        } catch (\RuntimeException $e) {
            echo 'Job Not found';
            return false;
        }

        # Attach Job Entity to Layout
        $this->setViewEntity($oJob);

        # Add Buttons for breadcrumb
        $this->setViewButtons('job-view');

        # Load Tabs for View Form
        $this->setViewTabs($this->sSingleForm);

        # Load Fields for View Form
        $this->setFormFields($this->sSingleForm);

        # Log Performance in DB
        $aMeasureEnd = getrusage();
        $this->logPerfomance('job-view',$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"utime"),$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"stime"));

        return new ViewModel([
            'sFormName'=>$this->sSingleForm,
            'oJob'=>$oJob,
        ]);
    }
}
