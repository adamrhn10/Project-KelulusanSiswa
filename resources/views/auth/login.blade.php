<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LulusApp - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Left Column (40%) -->
        <div class="w-full md:w-2/5 bg-[#171C33] p-6 md:p-8 relative overflow-hidden">
            <!-- SVG Logo Placeholder -->
            <div class="w-40 h-10 mb-8">
                <svg viewBox="0 0 200 50" xmlns="http://www.w3.org/2000/svg">
                    <text x="0" y="30" font-family="Arial" font-weight="bold" font-size="24" fill="white">LulusApp</text>
                </svg>
            </div>
            
            <!-- Decorative Circles -->
            <div class="absolute -top-20 -right-20 w-64 h-64 rounded-full bg-[#1E233D] opacity-20"></div>
            <div class="absolute bottom-1/4 -left-20 w-40 h-40 rounded-full bg-[#2A3050] opacity-20"></div>
            <div class="absolute top-1/3 left-1/4 w-24 h-24 rounded-full bg-[#3A4166] opacity-20"></div>
            
            <!-- Welcome Text -->
            <div class="absolute bottom-8 left-8 text-white text-sm">
                <div>Hey</div>
                <div class="text-xl font-medium mt-1">Welcome to</div>
                <div class="text-xl font-medium">LulusApp</div>
            </div>
        </div>
        
        <!-- Right Column (60%) -->
        <div class="w-full md:w-3/5 bg-white p-6 md:p-12 lg:p-20 flex flex-col justify-center">
            <div class="max-w-md mx-auto w-full">
                <!-- Login Title -->
                <h1 class="text-3xl font-bold text-gray-800 mb-8">Login</h1>
                
                <!-- Login Form -->
                <form class="space-y-6">
                    <!-- Email Input -->
                    <div>
                        <input 
                            type="email" 
                            placeholder="Email" 
                            class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#1A1F36] focus:border-transparent"
                            required
                        >
                    </div>
                    
                    <!-- Password Input -->
                    <div>
                        <input 
                            type="password" 
                            placeholder="Password" 
                            class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#1A1F36] focus:border-transparent"
                            required
                        >
                    </div>
                    
                    <!-- Links Row -->
                    <div class="flex justify-between items-center text-sm">
                        <a href="#" class="text-gray-500 hover:text-gray-700">Don't have an account? Sign up</a>
                        <a href="#" class="text-gray-500 hover:text-gray-700">Forgot password?</a>
                    </div>
                    
                    <!-- Login Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-[#1A1F36] hover:bg-[#232844] text-white font-medium py-3 px-4 rounded-full uppercase focus:outline-none focus:ring-2 focus:ring-[#7B61FF] focus:ring-opacity-50 transition duration-200"
                    >
                        Login
                    </button>

                    
                    <!-- Support Text -->
                    <p class="text-gray-500 text-sm text-center mt-12">
                        If you have any issues logging in, please contact us at<br>
                        support@positiveprime.com
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>