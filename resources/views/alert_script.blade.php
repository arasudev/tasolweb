<script type="text/javascript">
    function showSessionMessage(message, type, header) {
        GrowlNotification.notify({
            title: header,
            description: message,
            type: type,
            position: 'top-right',
            closeTimeout: 3000,
            showProgress: true
        });
    }

    if ('{{ session('success') }}') {
        alert('success');
        showSessionMessage('{{ session('success') }}', 'success', 'Success!');
    } else if ('{{ session('error') }}') {
        alert('error');
        showSessionMessage('{{ session('error') }}', 'error', 'Warning!');
    }
</script>
