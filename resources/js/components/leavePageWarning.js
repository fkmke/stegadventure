export function leavePageWarning() {
    window.addEventListener("beforeunload", function (e) {
        var confirmationMessage = 'Are you sure you want to quit the experiment? All you changes will be lost.';

        (e || window.event).returnValue = confirmationMessage; //Gecko + IE
        return confirmationMessage; //Gecko + Webkit, Safari, Chrome etc.
    });
};
