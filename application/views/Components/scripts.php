<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var alertBox = document.getElementById("alert");
        if (alertBox) {
            setTimeout(function() {
                alertBox.style.display = "none";
            }, 4000);
        }
    });
</script>
