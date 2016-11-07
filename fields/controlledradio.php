<?php

class ControlledradioField extends RadioField {
	public function options() {
		return call_user_func($this->controller, $this);
	}
}