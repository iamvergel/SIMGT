<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>ChatBot Interface</title>
    <style>
        .loader {
            border: 4px solid #f3f3f3;
            /* Light grey */
            border-top: 4px solid #3498db;
            /* Blue */
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

    <!-- Chat Toggle Button -->
    <button
        class="fixed z-[500] bottom-4 right-4 inline-flex items-center justify-center w-14 h-14 bg-blue-500 hover:bg-blue-600 text-white rounded-full shadow-lg"
        type="button" onclick="toggleChat()">
        <i class="fas fa-comments text-2xl"></i>
    </button>

    <!-- Chat Window -->
    <div id="chatWindow"
        class="fixed z-[500] bottom-20 right-4 bg-white w-[400px] h-[550px] rounded-xl shadow-lg border overflow-hidden hidden flex flex-col">

        <!-- Header Section -->
        <div class="bg-gradient-to-r from-blue-500 to-indigo-500 p-4 text-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-300 to-indigo-400 p-1">
                    <img src="https://via.placeholder.com/40" alt="Support Avatar" class="w-full h-full rounded-full">
                </div>
                <div>
                    <h2 class="text-lg font-semibold">Chat with us!</h2>
                    <p class="text-sm text-green-200">We reply immediately.</p>
                </div>
            </div>
            <button class="text-white" onclick="toggleChat()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Chat Messages Section -->
        <div id="msgContainer" class="flex-1 p-4 overflow-y-auto bg-gray-50">
            <div class="flex gap-2 my-2">
                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                    <i class="fas fa-robot text-gray-600"></i>
                </div>
                <div class="bg-gray-100 p-3 rounded-lg text-sm">
                    Hello! How can we assist you today?
                </div>
            </div>
            <!-- Loading Indicator -->
            <div id="loading" class="hidden p-4">
                <div class="flex items-center justify-center">
                    <div class="loader"></div>
                </div>
            </div>

            <!-- Predefined Options -->
            <div id="topicButtons" class="p-4 bg-white grid grid-cols-1 gap-2">
                <!-- Buttons will be added dynamically -->
            </div>
        </div>

    </div>

    <script>
        const conversations = [
            {
                "question": "Do you ship internationally?",
                "answer": "Yes, we ship to over 100 countries worldwide."
            },
            {
                "question": "Why are your prices so low?",
                "answer": "We negotiate directly with suppliers to offer the best prices."
            },
            {
                "question": "How do I track my order?",
                "answer": "You can track your order using the tracking number sent to your email."
            },
            {
                "question": "How much is shipping?",
                "answer": "Shipping is free on orders above $50."
            },
            {
                "question": "Other question",
                "answer": "Please let us know your specific query, and we'll help you out!"
            }
        ];

        let clickedButtons = new Set();

        function init() {
            addButtons();
        }

        function addButtons() {
            const buttonContainer = document.getElementById("topicButtons");
            buttonContainer.innerHTML = ""; // Clear previous buttons

            conversations.forEach((item, index) => {
                const button = document.createElement("button");
                button.innerHTML = item.question;
                button.className = "w-full py-3 border border-blue-500 text-blue-500 rounded-full hover:bg-blue-500 hover:text-white transition duration-200";

                // Disable button if it has been clicked before
                if (clickedButtons.has(index)) {
                    button.disabled = true;
                    button.classList.add("opacity-50", "cursor-not-allowed");
                } else {
                    button.onclick = () => handleButtonClick(index);
                }

                buttonContainer.appendChild(button);
            });
        }

        function handleButtonClick(index) {
            const { question, answer } = conversations[index];
            displayMessage("You", question);

            // Show loading indicator
            document.getElementById("loading").classList.remove("hidden");

            // Disable the clicked button
            clickedButtons.add(index);
            addButtons(); // Refresh buttons to reflect the disabled state

            setTimeout(() => {
                displayMessage("AI", answer);
                document.getElementById("loading").classList.add("hidden"); // Hide loading indicator
            }, 1000); // Simulate response delay
        }

        function displayMessage(sender, message) {
            const msgContainer = document.getElementById('msgContainer');
            const msgElement = document.createElement("div");
            msgElement.className = `flex gap-2 my-2 ${sender === "You" ? "justify-end" : ""}`;

            msgElement.innerHTML = `
                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                    <i class="fas ${sender === "AI" ? "fa-robot" : "fa-user"} text-gray-600"></i>
                </div>
                <div class="bg-${sender === "AI" ? "gray-100" : "blue-100"} p-3 rounded-lg text-sm">
                    ${message}
                </div>`;
            msgContainer.appendChild(msgElement);
            msgContainer.scrollTop = msgContainer.scrollHeight; // Scroll to bottom
        }

        function toggleChat() {
            const chatWindow = document.getElementById("chatWindow");
            chatWindow.classList.toggle("hidden");
        }

        window.onload = init;
    </script>

</body>

</html>