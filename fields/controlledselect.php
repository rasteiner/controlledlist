<?php

class ControlledselectField extends SelectField {
	public function options() {
		return call_user_func($this->controller, $this);
	}
}