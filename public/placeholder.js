var doc = document,
    body = doc.body,
    inputs = doc.getElementsByTagName("input"),
    txtarea = doc.getElementsByTagName("textarea"),
    combined = [],
    len,
    placeholder, 
    lastInputSelected;

/**
 * Following function determines whether the previously selected input should have its original placeholder value re-inserted.
 * And then based on the currently selected input works out if it should have it's placeholder text removed so user can enter their own value.
 *
 * @param e { Object } standardised event object
 * @return undefined {  } no explicitly returned value
 */	
function inputHandler(e) {
	var targ = e.target || e.srcElement,
        type = e.type;
		 
	placeholder = targ.getAttribute("placeholder");
	
	// If there was an input previously selected...
	if (lastInputSelected !== undefined) {
		// ...then check to make sure that if it was left blank...
		if (lastInputSelected.value === '') {
			// ...that its value is set back to it's placeholder value
			lastInputSelected.value = lastInputSelected.getAttribute("placeholder");
		}
	}
	
	// If the target element has a placeholder...
	if (placeholder !== null) {
		
		// ...then store it as the last input selected...
		lastInputSelected = targ;
		
		if (type === "blur") {
			if (targ.value === "") {
				targ.value = placeholder;
			}
		} else {
			// ...then check if its value is the same as its placeholder and clear the value if so...
			if (targ.value === placeholder) {
				targ.value = "";
			}
		}
		
	}
}

/*
 * To combine the two Arrays it would have been nice to just do:
 *     var combined = [].concat(Array.prototype.slice.call(inputs), Array.prototype.slice.call(txtarea));
 * But Internet Explorer fails with this, so we have merge the objects the long way!
 */

for (var i = 0; i < inputs.length; i++) {
    combined.push(inputs[i]);
}

for (var j = 0; j < txtarea.length; j++) {
    combined.push(txtarea[j]);
}
	
len = combined.length;

	while (len--) {
	// Make sure the input has a placeholder attribute AND isn't a password field (for the time being I'm ignoring password fields)
	if (combined[len].getAttribute('placeholder') !== null && combined[len].type !== 'password') {
		// Set the value of the input to the placeholder value
		combined[len].value = combined[len].getAttribute('placeholder');
	}
}

// To get Event Delegation to work we need to listen for 'focus' & 'blur' events.
// Firefox & WebKit have useCapture set to true which initiates capturing (rather than bubbling)
// Internet Explorer uses attachEvent to listen to 'focusin' event (as it can only handling bubbling phase)
if ("addEventListener" in window) {
    body.addEventListener("focus", inputHandler, true);
    body.addEventListener("blur", inputHandler, true);
} else {
	body.attachEvent("onfocusin", inputHandler);
	body.attachEvent("onfocusout", inputHandler);
}