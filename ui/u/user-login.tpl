<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, maximum-scale=1"
        />
        <title>{Lang::T('Login')} - {$_c['CompanyName']}</title>
        <link
            rel="shortcut icon"
            href="ui/ui/images/logo.png"
            type="image/x-icon"
        />
        <link rel="stylesheet" href="ui/ui/styles/tailwind.min.css" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </head>

    <body class="h-screen overflow-hidden">
        <main class="flex flex-wrap w-full h-full">
            <div class="w-1/2 hidden md:block md:h-full md:flex flex-col p-8">
                <a href="#" class="text-2xl font-bold"> {$_c['CompanyName']} </a>
                <div class="flex md:flex-grow justify-center items-center">
                <img
                    class="hidden w-full h-full md:block"
                    src="/ui/ui/images/transactions.svg"
                />
                </div>
            </div>
            <div class="flex flex-col w-full md:w-1/2">
                <div
                    class="flex flex-col justify-center items-center px-8 pt-8 my-auto md:justify-start md:pt-0 md:px-24 lg:px-32"
                >
                <a href="#" class="md:hidden mb-16 text-3xl font-bold p-4"> {$_c['CompanyName']} </a>
                    <form class="flex flex-col pt-3 md:pt-8 md:w-96">
                        <p class="text-3xl text-center">Welcome back.</p>
                        <div class="flex flex-col pt-4">
                            <div class="flex relative">
                                <span
                                    class="inline-flex items-center px-3 border-t bg-white border-l border-b border-gray-300 text-gray-500 shadow-sm text-sm"
                                >
                                    <svg
                                        width="15"
                                        height="15"
                                        fill="currentColor"
                                        viewBox="0 0 1792 1792"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M1792 710v794q0 66-47 113t-113 47h-1472q-66 0-113-47t-47-113v-794q44 49 101 87 362 246 497 345 57 42 92.5 65.5t94.5 48 110 24.5h2q51 0 110-24.5t94.5-48 92.5-65.5q170-123 498-345 57-39 100-87zm0-294q0 79-49 151t-122 123q-376 261-468 325-10 7-42.5 30.5t-54 38-52 32.5-57.5 27-50 9h-2q-23 0-50-9t-57.5-27-52-32.5-54-38-42.5-30.5q-91-64-262-182.5t-205-142.5q-62-42-117-115.5t-55-136.5q0-78 41.5-130t118.5-52h1472q65 0 112.5 47t47.5 113z"
                                        ></path>
                                    </svg>
                                </span>
                                <input
                                    type="text"
                                    id="design-login-email"
                                    name="username"
                                    class="flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    placeholder="Email"
                                />
                            </div>
                        </div>
                        <div class="flex flex-col pt-4 mb-12">
                            <div class="flex relative">
                                <span
                                    class="inline-flex items-center px-3 border-t bg-white border-l border-b border-gray-300 text-gray-500 shadow-sm text-sm"
                                >
                                    <svg
                                        width="15"
                                        height="15"
                                        fill="currentColor"
                                        viewBox="0 0 1792 1792"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M1376 768q40 0 68 28t28 68v576q0 40-28 68t-68 28h-960q-40 0-68-28t-28-68v-576q0-40 28-68t68-28h32v-320q0-185 131.5-316.5t316.5-131.5 316.5 131.5 131.5 316.5q0 26-19 45t-45 19h-64q-26 0-45-19t-19-45q0-106-75-181t-181-75-181 75-75 181v320h736z"
                                        ></path>
                                    </svg>
                                </span>
                                <input
                                    type="password"
                                    name="password"
                                    id="design-login-password"
                                    class="flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    placeholder="Password"
                                />
                            </div>
                        </div>
                        <button
                            type="submit"
                            class="w-full px-4 py-2 text-base font-semibold text-center text-white transition duration-200 ease-in bg-black shadow-md hover:text-black hover:bg-white focus:outline-none focus:ring-2"
                        >
                            <span class="w-full"> Submit </span>
                        </button>
                    </form>
                </div>
            </div>
        </main>
        <script src="ui/ui/scripts/vendors.js?v=1"></script>
    </body>
</html>
