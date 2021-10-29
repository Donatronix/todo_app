<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

/**
 * Trait ControllerTrait
 * @package App\Traits
 */
trait ControllerTrait
{
       use FlashMessages;

    /**
     * @var null
     */
    protected $data = null;

    /**
     * @param $title
     * @param $subTitle
     */
    public function setPageTitle($title, $subTitle = null)
    {
        view()->share(['pageTitle' => $title, 'subTitle' => $subTitle]);
    }


    /**
     * @param array $value
     */
    public function setPageValue(array $value)
    {
        view()->share($value);
    }

    /**
     * @param int $errorCode
     * @param null $message
     * @return Response
     */
    public function showErrorPage(int $errorCode = 404, $message = null): Response
    {
        $data['message'] = $message;
        return response()->view('errors.' . $errorCode, $data, $errorCode);
    }

    /**
     * @param bool $error
     * @param int $responseCode
     * @param array $message
     * @param null $data
     * @return JsonResponse
     */
    public function responseJson(bool $error = true, int $responseCode = 200, array $message = [], $data = null): JsonResponse
    {
        return response()->json([
            'error' => $error,
            'response_code' => $responseCode,
            'message' => $message,
            'data' => $data
        ]);
    }


    /**
     * @param string $route
     * @param string $message
     * @param string $type
     * @param false $error
     * @param false $withOldInputWhenError
     * @return RedirectResponse
     */
    public function responseRedirect(string $route, string $message, string $type = 'info', bool $error = false, bool $withOldInputWhenError = false): RedirectResponse
    {
        $this->displayFlashMessage($message, $type);

        if ($error && $withOldInputWhenError) {
            return redirect()->back()->withInput();
        }

        return redirect()->route($route);
    }

    /**
     * @param string $message
     * @param string $type
     * @param bool $error
     * @param bool $withOldInputWhenError
     * @return RedirectResponse
     */
    public function responseRedirectBack(string $message, string $type = 'info', bool $error = false, bool $withOldInputWhenError = false): RedirectResponse
    {
        $this->displayFlashMessage($message, $type);
        if ($error && $withOldInputWhenError) {
            return redirect()->back()->withInput();
        }
        return redirect()->back();
    }
}
