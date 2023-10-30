<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGlobalSettingRequest;
use App\Http\Requests\UpdateGlobalSettingRequest;
use App\Http\Resources\Admin\GlobalSettingResource;
use App\Models\GlobalSetting;
use Exception;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @title Global Setting Control
 */
class GlobalSettingsApiController extends Controller
{

    /**
     * @title Get OTP ACTIVE STATUS
     * @description No Token Verify. Result = TRUE => Active / FALSE => Inactive
     * @author 开发者
     * @url /global-settings
     * @method GET
     * 
     * @return status:true
     * @return MSG:Success
     * 
     */
    public function index()
    {
        try {

            $result = false;

            $globalSetting = GlobalSetting::where([
                'type'  => 3
            ])->first();

            $globalSetting['value'] = json_decode($globalSetting['value']);

            if (!isset($globalSetting->value->otp_status)) {
                return response()->json(['status' => FALSE, 'MSG' => 'Something Error !']);
            }

            if ($globalSetting->value->otp_status == 1) {
                $result = true;
            }
        } catch (Exception $e) {
            return response()->json(['status' => FALSE, 'MSG' => 'Something Error !']);
        }

        return response()->json(['status' => TRUE, 'MSG' => 'Success !', 'result' => $result]);
    }

    /**
     * @title Get ACCOUNT VERIFY ACTIVE STATUS
     * @description No Token Verify. Result = TRUE => Active / FALSE => Inactive
     * @author 开发者
     * @url /get-account-verify-status
     * @method GET
     * 
     * @return status:true
     * @return MSG:Success
     * 
     */
    public function get_account_verify_status()
    {
        try {

            $result = false;

            $globalSetting = GlobalSetting::where([
                'type'  => 3
            ])->first();

            $globalSetting['value'] = json_decode($globalSetting['value']);

            if (!isset($globalSetting->value->account_verify_status)) {
                return response()->json(['status' => FALSE, 'MSG' => 'Something Error !']);
            }

            if ($globalSetting->value->account_verify_status == 1) {
                $result = true;
            }
        } catch (Exception $e) {
            return response()->json(['status' => FALSE, 'MSG' => 'Something Error !']);
        }

        return response()->json(['status' => TRUE, 'MSG' => 'Success !', 'result' => $result]);
    }

    public function store(StoreGlobalSettingRequest $request)
    {
        //
    }

    public function show(GlobalSetting $globalSetting)
    {
        //
    }

    public function update(UpdateGlobalSettingRequest $request, GlobalSetting $globalSetting)
    {
        //
    }

    public function destroy(GlobalSetting $globalSetting)
    {
        // 
    }
}
