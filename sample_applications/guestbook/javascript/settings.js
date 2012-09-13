function deleteAccount() {
    var form = document.getElementById('settings_form');
    var agree = confirm("Delete account?");

    if(agree) {
        form.delete_flag.value = 1;
        form.submit();
    }
}
