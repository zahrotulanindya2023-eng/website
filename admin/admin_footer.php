    </div><!-- end admin-main -->
</div><!-- end admin-content -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Auto dismiss alerts
setTimeout(() => {
    document.querySelectorAll('.alert').forEach(a => {
        const bsAlert = bootstrap.Alert.getOrCreateInstance(a);
        bsAlert.close();
    });
}, 5000);
</script>
</body>
</html>
