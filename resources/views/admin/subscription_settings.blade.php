<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Settings</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Subscription Settings</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('subscription.settings.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $settings->title ?? '' }}" required>
            </div>
            <div class="form-group">
                <label for="targeting_rule">Targeting Rule</label>
                <input type="text" class="form-control" id="targeting_rule" name="targeting_rule" value="{{ $settings->targeting_rule ?? '' }}" required>
            </div>
            <div class="form-group">
                <label for="overlay_type">Overlay Type</label>
                <select class="form-control" id="overlay_type" name="overlay_type" required>
                    <option value="modal" {{ (isset($settings->overlay_type) && $settings->overlay_type == 'modal') ? 'selected' : '' }}>Modal Overlay</option>
                    <option value="footer" {{ (isset($settings->overlay_type) && $settings->overlay_type == 'footer') ? 'selected' : '' }}>Footer SlideIn</option>
                </select>
            </div>
            <div class="form-group">
                <label for="display_rule">Display Rule</label>
                <select class="form-control" id="display_rule" name="display_rule" required>
                    <option value="once_per_session" {{ (isset($settings->display_rule) && $settings->display_rule == 'once_per_session') ? 'selected' : '' }}>Once per Session</option>
                    <option value="once_per_day" {{ (isset($settings->display_rule) && $settings->display_rule == 'once_per_day') ? 'selected' : '' }}>Once per Day</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save Settings</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
