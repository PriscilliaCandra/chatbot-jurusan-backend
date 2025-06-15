<template>
    <div class="min-h-screen flex flex-col bg-gray-50 items-center py-8">
        <div class="w-full max-w-3xl bg-white shadow-xl rounded-lg flex flex-col h-[80vh] overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white p-4 rounded-t-lg flex items-center justify-between shadow-md">
                <h1 class="text-2xl font-bold font-cinzel">Chatbot</h1>
                <button @click="clearChat" class="text-white text-sm opacity-80 hover:opacity-100 transition-opacity">
                    Clear Chat
                </button>
            </div>

            <!-- Daftar Pertanyaan yang Tersedia -->
            <div v-if="availableQuestions.length > 0" class="p-4 bg-gray-50 border-b">
                <h3 class="text-sm font-medium text-gray-700 mb-2">Pertanyaan yang Tersedia:</h3>
                <div class="flex flex-wrap gap-2">
                    <button 
                        v-for="question in availableQuestions" 
                        :key="question.id"
                        @click="useSuggestedQuestion(question.questions)"
                        class="text-xs bg-white border border-gray-200 hover:border-blue-500 hover:text-blue-600 px-3 py-1.5 rounded-full transition-all shadow-sm"
                    >
                        {{ question.questions }}
                    </button>
                </div>
            </div>

            <div class="flex-1 p-6 overflow-y-auto space-y-4" ref="chatMessages">
                <div v-for="(msg, index) in chatHistory" :key="index"
                    :class="{
                    'flex justify-end': msg.sender === 'user',
                    'flex justify-start': msg.sender === 'bot'
                    }">
                    <div :class="{
                            'bg-blue-500 text-white rounded-bl-xl rounded-t-xl': msg.sender === 'user',
                            'bg-gray-200 text-gray-800 rounded-br-xl rounded-t-xl': msg.sender === 'bot'
                        }"
                        class="max-w-[75%] p-3 shadow-sm text-sm">
                        <p>{{ msg.message }}</p>
                    </div>
                </div>
                <div v-if="isTyping" class="flex justify-start">
                    <div class="bg-gray-200 text-gray-800 rounded-br-xl rounded-t-xl max-w-[75%] p-3 shadow-sm text-sm">
                        <span class="typing-indicator"></span>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-200 p-4 bg-gray-100 flex items-center">
                <input
                v-model="newMessage"
                @keyup.enter="sendMessage"
                type="text"
                placeholder="Tanyakan sesuatu tentang perkuliahan..."
                class="flex-1 p-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-sm"
                :disabled="isTyping"
                />
                <button
                @click="sendMessage"
                :disabled="!newMessage.trim() || isTyping"
                class="ml-3 bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full shadow-md transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'ChatbotPage',
    data() {
        return {
            chatHistory: [],
            newMessage: '',
            isTyping: false,
            availableQuestions: []
        };
    },
    methods: {
        async sendMessage() {
            if (!this.newMessage.trim()) return;

            const userMessage = this.newMessage;
            this.chatHistory.push({ sender: 'user', message: userMessage });
            this.newMessage = '';
            this.scrollToBottom();
            this.isTyping = true;

            try {
                const token = localStorage.getItem('token');
                if (!token) {
                    throw new Error('Authentication token not found. Please log in.');
                }

                const response = await axios.post(
                    'http://localhost:8000/api/chatbot/ask',
                    { 
                        message: userMessage
                    },
                    {
                        headers: {
                            Authorization: `Bearer ${token}`,
                            'Content-Type': 'application/json',
                        },
                    }
                );

                const botReply = response.data.reply;
                this.chatHistory.push({ sender: 'bot', message: botReply });

                // Update suggested questions if available
                if (response.data.suggested_questions) {
                    this.availableQuestions = response.data.suggested_questions;
                }

                // Jika user belum melakukan tes kepribadian
                if (response.data.needs_personality_test) {
                    this.$router.push('/personality-test');
                }
            } 
            catch (error) {
                console.error('Error sending message to chatbot:', error);
                let errorMessage = 'Oops! Something went wrong. Please try again.';

                if (error.response && error.response.data && error.response.data.message) {
                    errorMessage = `Error: ${error.response.data.message}`;
                } else if (error.message) {
                    errorMessage = `Network error: ${error.message}`;
                }

                this.chatHistory.push({ sender: 'bot', message: errorMessage });
            } 
            finally {
                this.isTyping = false;
                this.scrollToBottom();
            }
        },

        useSuggestedQuestion(question) {
            this.newMessage = question;
            this.sendMessage();
        },

        scrollToBottom() {
            this.$nextTick(() => {
                const chatMessages = this.$refs.chatMessages;
                if (chatMessages) {
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }
            });
        },

        clearChat() {
            this.chatHistory = [];
        },

        async loadChatHistory() {
            try {
                const token = localStorage.getItem('token');
                if (!token) return;

                const response = await axios.get(
                    'http://localhost:8000/api/chatbot/history',
                    {
                        headers: {
                            Authorization: `Bearer ${token}`,
                        },
                    }
                );

                this.chatHistory = response.data.map(item => ({
                    sender: item.sender,
                    message: item.message
                }));
            } catch (error) {
                console.error('Error loading chat history:', error);
            }
        },

        async loadAvailableQuestions() {
            try {
                const token = localStorage.getItem('token');
                if (!token) return;

                const response = await axios.get(
                    'http://localhost:8000/api/chatbot/questions',
                    {
                        headers: {
                            Authorization: `Bearer ${token}`,
                        },
                    }
                );

                this.availableQuestions = response.data;
            } catch (error) {
                console.error('Error loading available questions:', error);
                // Jika error karena belum tes kepribadian, redirect ke halaman tes
                if (error.response && error.response.status === 400) {
                    this.$router.push('/personality-test');
                }
            }
        }
    },
    mounted() {
        this.scrollToBottom();
        this.loadChatHistory();
        this.loadAvailableQuestions();
    }
};
</script>

<style scoped>
.font-cinzel {
    font-family: 'Cinzel Decorative', cursive;
}

.typing-indicator::after {
    content: 'Memikirkan jawaban...';
    animation: typing 2s infinite steps(20, end);
    display: inline-block;
    overflow: hidden;
    white-space: nowrap;
    vertical-align: bottom;
}

@keyframes typing {
    from { width: 0 }
    to { width: 100% }
}
</style> 