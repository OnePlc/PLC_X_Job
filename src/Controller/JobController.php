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

use Application\Controller\CoreEntityController;
use Application\Model\CoreEntityModel;
use OnePlace\Contact\Address\Model\AddressTable;
use OnePlace\Contact\Model\ContactTable;
use OnePlace\Job\Model\Job;
use OnePlace\Job\Model\JobTable;
use Laminas\View\Model\ViewModel;
use Laminas\Db\Adapter\AdapterInterface;

class JobController extends CoreEntityController {
    /**
     * Job Table Object
     *
     * @since 1.0.0
     */
    protected $oTableGateway;

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
        # You can just use the default function and customize it via hooks
        # or replace the entire function if you need more customization
        return $this->generateIndexView('job');
    }

    /**
     * Job Add Form
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function addAction() {
        /**
         * You can just use the default function and customize it via hooks
         * or replace the entire function if you need more customization
         *
         * Hooks available:
         *
         * job-add-before (before show add form)
         * job-add-before-save (before save)
         * job-add-after-save (after save)
         */
        return $this->generateAddView('job');
    }

    /**
     * Job Edit Form
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function editAction() {
        /**
         * You can just use the default function and customize it via hooks
         * or replace the entire function if you need more customization
         *
         * Hooks available:
         *
         * job-edit-before (before show edit form)
         * job-edit-before-save (before save)
         * job-edit-after-save (after save)
         */
        return $this->generateEditView('job');
    }

    /**
     * Job View Form
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function viewAction() {
        /**
         * You can just use the default function and customize it via hooks
         * or replace the entire function if you need more customization
         *
         * Hooks available:
         *
         * job-view-before
         */
        return $this->generateViewView('job');
    }

    public function attachJobForm($oItem = false) {
        $aJobs = [];
        if($oItem) {
            $oJobsDB = $this->oTableGateway->fetchAll(false, ['contact_idfs' => $oItem->getID()]);
            if(count($oJobsDB) > 0) {
                foreach($oJobsDB as $oJob) {
                    $aJobs[] = $oJob;
                }
            }
        }
        $oForm = CoreEntityController::$aCoreTables['core-form']->select(['form_key'=>'job-single']);

        $aFields = [];
        $aUserFields = CoreEntityController::$oSession->oUser->getMyFormFields();
        if(array_key_exists('job-single',$aUserFields)) {
            $aFieldsTmp = $aUserFields['job-single'];
            if(count($aFieldsTmp) > 0) {
                # add all contact-base fields
                foreach($aFieldsTmp as $oField) {
                    if($oField->tab == 'job-base') {
                        $aFields[] = $oField;
                    }
                }
            }
        }

        $aFieldsByTab = ['job-base'=>$aFields];
        # Pass Data to View - which will pass it to our partial
        return [
            # must be named aPartialExtraData
            'aPartialExtraData' => [
                # must be name of your partial
                'contact_job'=> [
                    'oHistories'=>$aJobs,
                    'oForm'=>$oForm,
                    'aFormFields'=>$aFieldsByTab,
                ]
            ]
        ];
    }

    public function attachContactForm($oItem = false) {
        $oContact = false;
        if($oItem->contact_idfs != 0) {
            try {
                $oContactTbl = CoreEntityController::$oServiceManager->get(ContactTable::class);
            } catch(\RuntimeException $e) {

            }

            if(isset($oContactTbl)) {
                $oContact = $oContactTbl->getSingle($oItem->contact_idfs);
                try {
                    $oAddressTbl = CoreEntityController::$oServiceManager->get(AddressTable::class);
                } catch(\RuntimeException $e) {

                }
                if(isset($oAddressTbl)) {
                    $oAddresses = $oAddressTbl->fetchAll(false,['contact_idfs'=>$oContact->getID()]);
                    $oContact->oAddresses = $oAddresses;
                }
            }
        }

        $aFields = [];
        $aUserFields = CoreEntityController::$oSession->oUser->getMyFormFields();
        if(array_key_exists('contact-single',$aUserFields)) {
            $aFieldsTmp = $aUserFields['contact-single'];
            if(count($aFieldsTmp) > 0) {
                # add all contact-base fields
                foreach($aFieldsTmp as $oField) {
                    if($oField->tab == 'contact-base') {
                        $aFields[] = $oField;
                    }
                }
            }
        }

        # Pass Data to View - which will pass it to our partial
        return [
            # must be named aPartialExtraData
            'aPartialExtraData' => [
                # must be name of your partial
                'job_contact'=> [
                    'oContact'=>$oContact,
                    'aFields'=>$aFields,
                ]
            ]
        ];
    }
}
