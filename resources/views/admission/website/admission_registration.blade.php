@include('admission.includes.header')

<body class="font-poppins bg-gray-200 overflow-hidden">

    <div class="flex w-full h-screen">
        <!-- Sidebar -->
        @include('admission.includes.sidebar')

        <!-- Main Content -->
        <main class="flex-grow rounded-r-lg bg-white shadow-lg overflow-y-scroll w-full bg-zinc-50" id="content">
            <header class="sticky top-0 z-[10]">
                @include('admission.includes.topnav')
            </header>

            <div class="p-5">
                <!-- Toggle Switch for Registration Button -->
                <label for="registrationToggle" class="switch">
                    <input type="checkbox" id="registrationToggle" onchange="toggleRegistrationStatus()" />
                    <span class="slider round"></span>
                </label>

                <!-- Display the current status -->
                <div id="statusMessage">
                    Loading status...
                </div>

                <!-- Add some basic CSS to style the switch -->
                <style>
                    .switch {
                        position: relative;
                        display: inline-block;
                        width: 34px;
                        height: 20px;
                    }

                    .switch input {
                        opacity: 0;
                        width: 0;
                        height: 0;
                    }

                    .slider {
                        position: absolute;
                        cursor: pointer;
                        top: 0;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        background-color: #ccc;
                        transition: 0.4s;
                        border-radius: 50px;
                    }

                    .slider:before {
                        position: absolute;
                        content: "";
                        height: 12px;
                        width: 12px;
                        border-radius: 50px;
                        left: 4px;
                        bottom: 4px;
                        background-color: white;
                        transition: 0.4s;
                    }

                    input:checked+.slider {
                        background-color: #4CAF50;
                    }

                    input:checked+.slider:before {
                        transform: translateX(14px);
                    }
                </style>

                <script>
                    // Fetch and display the current status when the page loads
                    $(document).ready(function () {
                        $.ajax({
                            url: '/registration-button/status', // Ensure this is correct
                            method: 'GET',
                            success: function (data) {
                                const toggle = $('#registrationToggle');
                                if (data.status === 'Active') {
                                    toggle.prop('checked', true);
                                    $('#statusMessage').text('Registration is Active');
                                } else {
                                    toggle.prop('checked', false);
                                    $('#statusMessage').text('Registration is Inactive');
                                }
                            },
                            error: function (error) {
                                console.error('Error:', error);
                            }
                        });
                    });

                    // Function to toggle the registration status
                    function toggleRegistrationStatus() {
                        $.ajax({
                            url: '/registration-button/toggle', // Ensure this is correct
                            method: 'PATCH',
                            dataType: 'json',
                            headers: {
                                "X-CSRF-TOKEN": '{{ csrf_token() }}',  // Add CSRF token for security
                            },
                            success: function (data) {
                                if (data.status === 'Active') {
                                    $('#statusMessage').text('Registration is Active');
                                } else {
                                    $('#statusMessage').text('Registration is Inactive');
                                }
                            },
                            error: function (error) {
                                console.error('Error:', error);
                            }
                        });
                    }
                </script>
            </div>
        </main>

    </div>
    @include('admin.includes.js-link')
    <script src="{{ asset('../js/admin/mgtgradeone.js') }}" type="text/javascript"></script>
</body>

</html>

