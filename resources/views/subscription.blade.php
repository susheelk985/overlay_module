<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribe</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <h2 align="center">Subsciption</h2><br><br>
    @php
        $settings = App\Models\SubscriptionSettings::first();
    @endphp
    @if($settings && $settings->targeting_rule == 'homepage')
        <div class="{{ $settings->overlay_type == 'footer' ? 'slide-in-footer' : 'modal' }}" id="subscriptionModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $settings->title }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="subscriptionForm">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <div class="invalid-feedback" id="emailError"></div>
                            </div>
                            <button type="submit" class="btn btn-primary">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                let displayRule = "{{ $settings->display_rule }}";
                let shouldShow = true;

                if (displayRule === 'once_per_day') {
                    let lastShown = localStorage.getItem('subscriptionLastShown');
                    console.log(new Date(lastShown).getTime());
                    if (lastShown && new Date().getTime() - new Date(lastShown).getTime() < 24 * 60 * 60 * 1000) {
                        shouldShow = false;
                    }
                } else if (displayRule === 'once_per_session') {
                    let lastShownSession = sessionStorage.getItem('subscriptionLastShown');
                    if (lastShownSession) {
                        shouldShow = false;
                    }
                }

                if (shouldShow) {
                    if (displayRule === 'once_per_day') {
                        localStorage.setItem('subscriptionLastShown', new Date().getTime());
                    } else if (displayRule === 'once_per_session') {
                        sessionStorage.setItem('subscriptionLastShown', new Date().getTime());
                    }

                    if ("{{ $settings->overlay_type }}" === 'footer') {
                        $('#subscriptionModal').addClass('slide-in');
                    } else {
                        $('#subscriptionModal').modal('show');
                    }
                }

                // Form submission with AJAX
                $('#subscriptionForm').on('submit', function(event) {
                    event.preventDefault();
                    var email = $('#email').val();

                    $.ajax({
                        url: "{{ route('subscribe') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            email: email
                        },
                        success: function(response) {
                            alert(response.message);
                            $('#subscriptionModal').modal('hide');
                        },
                        error: function(response) {
                            if (response.status === 422) {
                                $('#email').addClass('is-invalid');
                                $('#emailError').text(response.responseJSON.errors.email[0]);
                            }
                        }
                    });
                });
            });
        </script>

        <style>
            .slide-in-footer {
                position: fixed;
                bottom: 0;
                width: 100%;
                background-color: white;
                box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
                display: none;
            }
            .slide-in-footer.slide-in {
                display: block;
                animation: slideIn 0.5s forwards;
            }
            @keyframes slideIn {
                from {
                    bottom: -100%;
                }
                to {
                    bottom: 0;
                }
            }
        </style>
    @endif

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
