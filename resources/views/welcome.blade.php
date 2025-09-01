
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom Styles -->
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .card-shadow {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .btn-hover {
            transition: all 0.3s ease;
        }
        
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
    </style>
</head>
<body class="min-h-screen gradient-bg flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <!-- Welcome Card -->
        <div class="bg-white rounded-2xl card-shadow p-8 text-center">
            <!-- Logo/Icon -->
            <div class="mb-8">
                <div class="w-20 h-20 mx-auto bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center floating-animation">
                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            
            <!-- Welcome Text -->
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Welcome to Laravel</h1>
            <p class="text-gray-600 mb-8">Get started by logging in to your account or creating a new one.</p>
            
            <!-- Action Buttons -->
            <div class="space-y-4">
                <!-- Login Button -->
                <a href="{{ route('login') }}" class="block w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold py-3 px-6 rounded-lg btn-hover">
                    Login
                </a>
                
                <!-- Register Button -->
                <a href="{{ route('register') }}" class="block w-full bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold py-3 px-6 rounded-lg btn-hover">
                    Register
                </a>
            </div>
            
            <!-- Additional Links -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <p class="text-sm text-gray-500 mb-4">Need help?</p>
                <div class="flex justify-center space-x-4 text-sm">
                    <a href="#" class="text-blue-500 hover:text-blue-600 transition-colors">Documentation</a>
                    <a href="#" class="text-blue-500 hover:text-blue-600 transition-colors">Support</a>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-white text-sm opacity-75">
                Powered by Laravel {{ app()->version() }}
            </p>
        </div>
    </div>
    
    <!-- Background Decorative Elements -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-4 -right-4 w-72 h-72 bg-white opacity-10 rounded-full"></div>
        <div class="absolute -bottom-8 -left-8 w-96 h-96 bg-white opacity-5 rounded-full"></div>
    </div>
</body>
</html>