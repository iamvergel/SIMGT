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


<!-- Chat Toggle Button -->
<button
    class="fixed z-[14] bottom-[1.5rem] right-[1.5rem] lg:bottom-[2.5rem] lg:right-[3.5rem] inline-flex items-center justify-center w-14 h-14 bg-blue-500 hover:bg-blue-600 text-white rounded-full shadow-lg"
    type="button" onclick="toggleChat()" > 
    <i class="fa-brands fa-facebook-messenger text-2xl"></i>
</button>
<!-- onclick="window.open('//www.facebook.com/messages/t/343328209464206')" -->
<!-- Chat Window -->
<div id="chatWindow"
    class="fixed z-[13] bottom-[1rem] right-[1rem] lg:bottom-[2rem] lg:right-[3rem] bg-white w-[300px] h-[400px] lg:w-[350px] lg:h-[300px] rounded-xl shadow-lg border-2 border overflow-hidden hidden flex flex-col">

    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-800 p-4 text-white flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-300 to-blue-400 p-[0.1rem]">
                <img src="{{ asset('../assets/images/SELC.png') }}" alt="Support Avatar" class="w-full h-full rounded-full">
            </div>
            <div>
                <h2 class="text-sm font-semibold">St. Emelie Learning Center</h2>
            </div>
        </div>
        <button class="text-white" onclick="toggleChat()">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Chat Messages Section -->
    <div id="msgContainer" class="flex-1 p-4 overflow-y-auto bg-gray-50">
        <div class="flex gap-2 my-2">
            <div class="bg-gray-100 p-3 rounded-lg text-sm">
                Hello! 
                How can I help you?
            </div>
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
            window.open(`https://www.facebook.com/messages/t/${process.env.FB_PAGE_ID}`, '_blank'); // Direct to Facebook messenger
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