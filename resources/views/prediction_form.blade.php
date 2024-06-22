<!DOCTYPE html>
<html>

<head>
    <title>Prediksi Kehadiran Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #1e3c72, #2a5298);
            color: #ffffff;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .form-group label {
            font-weight: bold;
            color: #ffffff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-size: 1.2em;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .card {
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            background: rgba(255, 255, 255, 0.8);
            color: #333333;
        }

        .card-header {
            background: #007bff;
            color: #ffffff;
            border-radius: 10px 10px 0 0;
            text-align: center;
            padding: 20px;
            font-size: 1.5em;
        }

        .form-control {
            font-size: 1.1em;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 0.9em;
            color: #ffffff;
        }

        .modal-dialog {
            max-width: 800px;
            margin: 180px auto;
        }

        .modal-content {
            background-color: #007bff;
            color: #ffffff;
            border-radius: 15px;
        }

        .modal-header {
            background-color: #0056b3;
            color: #ffffff;
            border-radius: 10px 10px 0 0;
        }

        .modal-footer {
            background-color: #0056b3;
            border-radius: 0 0 15px 15px;
        }

        .close {
            color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Prediksi Kehadiran Mahasiswa
            </div>
            <form method="POST" action="{{ route('predict') }}" id="predictionForm">
                @csrf
                <div class="form-group">
                    <label for="on_time_frequency">Seberapa sering Anda hadir tepat waktu di kelas?</label>
                    <select class="form-control" id="on_time_frequency" name="on_time_frequency" required>
                        <option value="Selalu">Selalu</option>
                        <option value="Jarang">Jarang</option>
                        <option value="Tidak Pernah">Tidak Pernah</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="semester_compensations">Berapa jumlah kompen anda di setiap semester?</label>
                    <select class="form-control" id="semester_compensations" name="semester_compensations" required>
                        <option value="0 - 5 jam">0 - 5 jam</option>
                        <option value="6 - 9 jam">6 - 9 jam</option>
                        <option value="> 10 jam">> 10 jam</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="organization_absences">Seberapa sering kegiatan organisasi menyebabkan anda absen dari kelas?</label>
                    <select class="form-control" id="organization_absences" name="organization_absences" required>
                        <option value="Tidak Pernah">Tidak Pernah</option>
                        <option value="Jarang">Jarang</option>
                        <option value="Selalu">Selalu</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Prediksi</button>
            </form>
        </div>
    </div>
    <div class="footer">
        © 2024 Kelompok 6, Artificial Intelligence.
    </div>

    <!-- Modal -->
    <div class="modal fade" id="predictionModal" tabindex="-1" role="dialog" aria-labelledby="predictionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="predictionModalLabel">Hasil Prediksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="predictionResult">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#predictionForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: '/predict',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#predictionResult').html(response.message);
                        $('#predictionModal').modal('show');
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>

</body>

</html>