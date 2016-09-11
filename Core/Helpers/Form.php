<?php

namespace Core\Helpers;


class Form
{


    /**
     * "Démarre" un formulaire
     * @param $action
     * @param string $method
     * @param array $options
     * @return string
     */
    public static function start($action = null, $method = "POST", array $options = null)
    {
        $option = "";
        if ($options != null) {
            foreach ($options as $k => $v) {
                $option .= "$k='$v' ";
            }
        }

        if (!is_null($action)) {
            $action = "action=" . ROOT . $action;
        } else {
            $action = "#";
        }

        echo "<form $action method='$method' $option>";
    }

    /**
     * Ferme le formulaire
     * @param $value
     * @param array $options
     * @return string
     */
    public static function end($value = "Envoyer", array $options = null)
    {
        $option = "";
        if ($options != null) {
            foreach ($options as $k => $v) {
                $option .= "$k='$v' ";
            }
        }
        echo "<input type='submit' value='$value' $option></form>";
    }

    /**
     * Créer un champ input
     * @param $type
     * @param $field
     * @param bool $label
     * @param array $options
     * @param null $value
     * @param null $placeholder
     * @return string
     */
    public static function input($type, $field, $label = true, array $options = null, $value = null, $placeholder = null)
    {
        $option = "";
        if ($options != null) {
            foreach ($options as $k => $v) {
                if ($k != 'id') {
                    $option .= "$k='$v' ";
                }
            }
        }


        if (is_null($value)) {
            $value = "";
        } elseif ($type != "password") {
            $value = "value='$value'";
        }

        if (is_null($placeholder)) {
            $placeholder = "";
        } else {
            $placeholder = "placeholder='$placeholder'";
        }

        if (!$label) {
            $label = "";
        } else {
            $label = "<label for='$field'>$label : </label>";
        }

        echo "$label<input type='$type' name='$field' id='$field' $value $placeholder $option>";
    }

    /**
     * Créer un textarea
     * @param $field
     * @param array $options
     * @return string
     */
    public static function textarea($field, array $options = null, $content = null)
    {
        $option = "";
        if ($options != null) {
            foreach ($options as $k => $v) {
                if ($k != 'id') {
                    $option .= "$k='$v' ";
                }
            }
        }
        echo "<textarea id='$field' name='$field' $option>$content</textarea>";
    }

    /**
     * Créer un select
     * @param $field
     * @param $label
     * @param array $options
     * @param null $selected
     * @return string
     */
    public static function select($field, $label, array $options, $selected = null)
    {
        $return = "<label for='$field'>$label</label><select name='$field' id='$field'>";
        foreach ($options as $k => $v) {
            if ($k == $selected) {
                $slctd = "selected='selected'";
            } else {
                $slctd = "";
            }
            $return .= "<option $slctd value='$k'>$v</option>";
        }

        echo $return . "</select>";
    }

}