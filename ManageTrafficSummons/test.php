<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Example</title>
    <style>
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            margin: 4px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <form>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
        </div>
        <div class="form-group">
            <label for="violation">Violation:</label>
            <select id="violation" name="violation" required>
                <option value="speed">Speeding</option>
                <option value="nocomply">Not Complying</option>
                <option value="accident">Accident</option>
            </select>
        </div>
        <div class="form-group">
            <label for="startTime">Start Time:</label>
            <input type="time" id="startTime" name="startTime" required>
        </div>
    </form>
</body>
</html>