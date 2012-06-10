function deleteAccount() {
    var form = document.getElementById('deleteaccount');
    var agree = confirm("Delete account?");

    if(agree) {
        form.xdeleteflag.value = 1;
        form.submit();
    }
}
