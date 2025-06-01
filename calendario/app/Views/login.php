<?php
/** @var \CodeIgniter\View\View $this */
?>
<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container">
<div class="card shadow-lg form-signin mx-auto" style="max-width: 400px;">
        <div class="card-body p-5">
            <h1 class="fs-4 card-title fw-bold mb-4 text-center">Iniciar sesión</h1>
            <form method="POST" action="<?= base_url('auth'); ?>" autocomplete="off">
                <?= csrf_field(); ?>

                <div class="mb-3">
                    <label class="mb-2" for="user">Usuario</label>
                    <input type="text" class="form-control" name="user" id="user" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="mb-2">Contraseña</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="password" id="password" required>

                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>

                    <a href="<?= base_url('password-request'); ?>" class="float-end mt-2 text-decoration-underline">
                        Olvidé mi contraseña
                    </a>
                </div>

                <button type="submit" class="btn w-100 py-2 mt-4" style="background-color:  #001f3f; color: white;">
                    Ingresar
                </button>

            </form>

            <?php if (session()->getFlashdata('errors') !== null): ?>
                <div class="alert alert-danger my-3" role="alert">
                    <?= session()->getFlashdata('errors'); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="card-footer py-3 border-0">
            <div class="text-center">
                ¿No tienes una cuenta?
                <a href="<?= base_url('register'); ?>" class="text-dark text-decoration-underline">Regístrate aquí</a>
            </div>
        </div>
    </div>

    <!-- 👇 Esta parte queda fuera del card -->
    <div class="text-center mt-3">
        <p class="mb-2 text-muted">O bien puede</p>
        <a href="<?= base_url('/'); ?>" class="btn text-white" style="background-color:rgb(105, 104, 104);">
            Regresar a la página principal
        </a>
    </div>
</div>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<script>
    const togglePasswordButton = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');

    togglePasswordButton.addEventListener('click', function () {
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            togglePasswordButton.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            passwordField.type = 'password';
            togglePasswordButton.innerHTML = '<i class="fas fa-eye"></i>';
        }
    });
</script>

<?= $this->endSection(); ?>