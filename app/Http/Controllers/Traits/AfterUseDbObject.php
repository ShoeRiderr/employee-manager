<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

trait AfterUseDbObject
{
    private function rediretWithMessage(?bool $result, string $crudMethodName, string $modelName, string $route = '/'): Redirector|RedirectResponse
    {
        $messageKey = 'success';
        $message = __("crud.$crudMethodName", ['model' => $modelName]);

        if (!$result) {
            $messageKey = 'error';
            $message = __("validation.crud.$crudMethodName", ['model' => $modelName]);
        }

        return redirect($route)->with($messageKey, $message);
    }
}
