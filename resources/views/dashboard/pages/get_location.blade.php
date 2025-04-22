<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Location Request</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
            padding: 30px;
        }

        button {
            padding: 12px 20px;
            font-size: 16px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        #msg {
            margin-top: 20px;
            color: red;
            font-size: 16px;
        }

        #loading {
            margin-top: 10px;
            color: blue;
            font-size: 15px;
            display: none;
        }
    </style>
</head>

<body>

    <h2>Location Access Required</h2>
    <p>To continue, please allow location access on your device.</p>

    <button id="getLocationBtn">Share My Location</button>

    <div id="loading">Saving your location...</div>
    <div id="msg"></div>

    <script>
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const msg = document.getElementById("msg");
        const loading = document.getElementById("loading");


        async function getLocation() {
            msg.textContent = "";
            loading.style.display = "block";

            if (!navigator.geolocation) {
                msg.textContent = "Geolocation is not supported by your browser.";
                loading.style.display = "none";
                return;
            }

            navigator.geolocation.getCurrentPosition(async function(position) {
                    try {
                        const response = await fetch("{{ route('tracking.save-location') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": csrf
                            },
                            body: JSON.stringify({
                                token: "{{ $trackingRequest->token }}",
                                latitude: position.coords.latitude,
                                longitude: position.coords.longitude
                            })
                        });

                        const data = await response.json();

                        if (!response.ok) {
                            msg.textContent = data.message || "Something went wrong.";
                        } else {
                            alert(data.message || "Location shared successfully.");
                            window.close();
                        }
                    } catch (error) {
                        msg.textContent = "❌ Error: " + error.message;
                    } finally {
                        loading.style.display = "none";
                    }

                },
                function(error) {
                    loading.style.display = "none";

                    if (error.code === error.PERMISSION_DENIED) {
                        // User denied the location access, send cancel status to server
                        fetch("{{ route('tracking.save-location') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrf
                                },
                                body: JSON.stringify({
                                    token: "{{ $trackingRequest->token }}",
                                    denied: true
                                })
                            }).then(response => response.json())
                            .then(data => alert(data.message));

                        msg.innerHTML =
                            "🔒 Location access denied.<br>Enable it from your browser settings or system settings.";
                    } else if (error.code === error.POSITION_UNAVAILABLE) {
                        msg.textContent = "📍 Location unavailable. Please turn on device location.";
                    } else if (error.code === error.TIMEOUT) {
                        msg.textContent = "⏱️ Location request timed out.";
                    } else {
                        msg.textContent = "⚠️ Error: " + error.message;
                    }
                });
        }


        document.getElementById("getLocationBtn").addEventListener("click", getLocation);
    </script>

</body>

</html>
