<?php

namespace App\Form;

use App\Model;

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';

    public Model $model;
    public string $attribute;
    public string $type;

    /**
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        $this->type = 'text';
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        $hasError = $this->model->hasError($this->attribute);
        if (is_null($hasError)) $className = "";
        else $className = $hasError ? 'is-invalid' : 'is-valid';

        return sprintf(
            '<div class="form-group">
                <label>%s</label>
                <input type="%s" name="%s" value="%s" class="form-control %s">
                <div class="invalid-feedback">%s</div>
            </div>',
            $this->model->labels()[$this->attribute],
            $this->type,
            $this->attribute,
            $this->model->getAttribute($this->attribute),
            $className,
            $this->model->error($this->attribute),
        );
    }

    public function passwordType()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }
}
