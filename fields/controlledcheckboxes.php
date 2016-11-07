<?php

class ControlledcheckboxesField extends CheckboxesField {
	public function options() {
		return call_user_func($this->controller, $this);
	}
}