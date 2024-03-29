document.addEventListener('DOMContentLoaded', async () => {

    const chatbox = document.getElementById("chatbox");
    const chatContainer = document.getElementById("chat-container");
    const userInput = document.getElementById("user-input");
    const sendButton = document.getElementById("send-button");
    const openChatButton = document.getElementById("open-chat");
    const closeChatButton = document.getElementById("close-chat");

    let isChatboxOpen = true; // Set the initial state to open

    // Function to toggle the chatbox visibility
    function toggleChatbox() {
        chatContainer.classList.toggle("hidden");
        isChatboxOpen = !isChatboxOpen; // Toggle the state
    }

    // Add an event listener to the open chat button
    openChatButton.addEventListener("click", toggleChatbox);

    // Add an event listener to the close chat button
    closeChatButton.addEventListener("click", toggleChatbox);

    // Add an event listener to the send button
    sendButton.addEventListener("click", function () {
        const userMessage = userInput.value;
        if (userMessage.trim() !== "") {
            addUserMessage(userMessage);
            respondToUser(userMessage);
            userInput.value = "";
        }
    });



    userInput.addEventListener("keyup", function (event) {
        if (event.key === "Enter") {
            const userMessage = userInput.value;
            addUserMessage(userMessage);
            respondToUser(userMessage);
            userInput.value = "";
        }
    });


    // create msg for user side
    function addUserMessage(message) {
        const messageElement = document.createElement("div");
        messageElement.classList.add("mb-2", "text-right");
        const msgElement = document.createElement('p')
        msgElement.classList = 'bg-green-600 text-white rounded-lg py-2 px-4 inline-block'
        msgElement.textContent = message
        messageElement.appendChild(msgElement)
        chatbox.appendChild(messageElement);
        chatbox.scrollTop = chatbox.scrollHeight;
    }

    // create msg for bot side
    function addBotMessage(message, color = '') {
        const messageElement = document.createElement("div");
        messageElement.classList.add("mb-2");
        messageElement.innerHTML = `<p class=" ${color && color}bg-gray-200 text-gray-700 rounded-lg py-2 px-4 inline-block">${message}</p>`;
        chatbox.appendChild(messageElement);
        chatbox.scrollTop = chatbox.scrollHeight;
    }


    //create msg that bot thinking
    function addBotThinking(reponded) {
        if (reponded) {

            const messageElement = document.createElement("div");
            messageElement.classList.add("mb-2");
            messageElement.innerHTML = `<p id='think' class="bg-gray-200 text-gray-700 rounded-lg py-2 px-4 flex justify-start items-center gap-x-1">Thinking            
            <span class='h-1.5 w-1.5 bg-gray-300 rounded-full animate-bounce [animation-delay:-0.3s]'></span>
            <span class='h-1.5 w-1.5 bg-gray-300 rounded-full animate-bounce [animation-delay:-0.15s]'></span>
            <span class='h-1.5 w-1.5 bg-gray-300 rounded-full animate-bounce'></span></p>`;
            chatbox.appendChild(messageElement);
            chatbox.scrollTop = chatbox.scrollHeight;
        } else {
            document.getElementById('think').remove()
        }
    }


    // function conect with chatgpt
    function respondToUser(userMessage) {

        // chatbot logic
        const API_URL = 'https://api.openai.com/v1/chat/completions';
        // change key with you'rs
        const API_KEY = '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';


        //display msg thinging
        addBotThinking(true)


        const requestOptions = {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                'Authorization': `Bearer ${API_KEY}`
            },
            body: JSON.stringify({
                model: "gpt-3.5-turbo",
                max_tokens: 100,
                messages: [{
                    role: "user",
                    content: `${userMessage}`
                }]
            })
        };

        fetch(API_URL, requestOptions)
            .then(res => res.json())
            .then(data => {
                //remove msg thinging
                addBotThinking(false)

                //display msg bot
                addBotMessage(data.choices[0].message.content);

            })
            .catch(error => {

                // if there is an error display it in chat
                addBotMessage('Oops something went wrong, Please try again .APi KEY', 'bg-red-50 text-red-500');


                //remove msg thinking
                addBotThinking(false)
            });




    }


})