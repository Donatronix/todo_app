<?php

namespace App\Traits;

/**
 * Trait FlashMessages
 * @package App\Traits
 */
trait FlashMessages
{
    /**
     * @var array
     */
    protected $errorMessages = [];

    protected $type;

    /**
     * @var array
     */
    protected $infoMessages = [];

    /**
     * @var array
     */
    protected $successMessages = [];

    /**
     * @var array
     */
    protected $warningMessages = [];

    /**
     * Set flash message
     *
     * @param string $message //Message to display
     * @param string $type //Message type (error, success, info, warning)
     *
     */
    protected function setFlashMessage($message, $type)
    {
        $model = 'infoMessages';
        $this->type = $type;
        switch ($type) {
            case 'info': {
                    $model = 'infoMessages';
                }
                break;
            case 'error': {
                    $model = 'errorMessages';
                }
                break;
            case 'success': {
                    $model = 'successMessages';
                }
                break;
            case 'warning': {
                    $model = 'warningMessages';
                }
                break;
        }

        if (is_array($message)) {
            foreach ($message as $key => $value) {
                array_push($this->$model, $value);
            }
        } else {
            array_push($this->$model, $message);
        }
    }

    /**
     * @return array
     */
    protected function getFlashMessages()
    {
        return [
            'error'     =>  $this->errorMessages,
            'info'      =>  $this->infoMessages,
            'success'   =>  $this->successMessages,
            'warning'   =>  $this->warningMessages,
        ];
    }

    /**
     * Flushing flash messages to Laravel's session
     */
    protected function showFlashMessages()
    {
        if ($this->type == 'info') {
            session()->flash('info', implode('<br/>', $this->infoMessages));
        }

        if ($this->type == 'error') {
            session()->flash('error', implode('<br/>', $this->errorMessages));
        }

        if ($this->type == 'success') {
            session()->flash('success', implode('<br/>', $this->successMessages));
        }
        if ($this->type == 'warning') {
            session()->flash('warning', implode('<br/>', $this->warningMessages));
        }

    }


    /**
     * Display flash message
     *
     * @param string $message //Message to display
     * @param string $type //Message type (error, success, info, warning)
     *
     * @return void
     */
    public function displayFlashMessage($message, $type)
    {
        $this->setFlashMessage($message, $type);
        $this->showFlashMessages();
    }
}
