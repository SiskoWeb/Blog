<section class="w-full  px-4 mx-auto bg-white dark:bg-[#111c2d] rounded-lg shadow-xl">




    <form class="p-4 flex flex-col min-w-0 break-words min-h-[500px]  w-full mb-6  mt-16">
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900 dark:text-white">Create Post</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600 dark:text-white">You can use Our AI To Help You Create Your Article.</p>
                <p id="error_msg" class="text-red-500"></p>
                <p id="successfully_msg" class="text-green-500"></p>
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="username" class="block text-sm font-medium leading-6 text-gray-900  dark:text-white">Title<span class="text-red-500">*</span></label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                                <input type="text" name="title" id="title" class="block flex-1 border-0 bg-transparent py-1.5 px-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="janesmith">
                            </div>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="about" class="block text-sm font-medium leading-6 text-gray-900  dark:text-white ">Content<span class="text-red-500">*</span></label>
                        <div class="mt-2">
                            <textarea id="content" name="content" rows="3" class="bg-transparent block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="category" class="block text-sm font-medium leading-6 text-gray-900  dark:text-white">Category<span class="text-red-500">*</span></label>
                        <div class="mt-2">

                            <select name="category" id="category" class="bg-white drak:text-white border-0 cursor-pointer rounded-lg  px-4 py-2 drop-shadow-md   w-72 duration-300 ">
                                <option value="" disabled selected="">selet Category</option>


                            </select>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="username" class="block text-sm font-medium leading-6 text-gray-900  dark:text-white">Tags</label>
                        <div class="mt-2">
                            <?php require('components\createPost\selectTags.php') ?>
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label for="photo" class="block text-sm font-medium leading-6 text-gray-900  dark:text-white">Cover</label>
                        <img id="displatImg" class="max-h-[100px] max-w-[100px] my-2" alt="post">
                        <input type="file" name="image" id="image" class="block max-w-[200px] mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" ">

                    </div>

                    <div class=" col-span-full">
                        <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900  dark:text-white">Cover photo<span class="text-red-500">*</span></label>
                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">

                        </div>
                    </div>
                </div>
            </div>


            <div class="mt-6 flex items-center justify-end gap-x-6">
                <a href="./profile.php" type="button" class="text-sm font-semibold leading-6 text-gray-900  dark:text-white">Cancel</a>
                <button type="button" id="btnCreate" class="rounded-md bg-[#0085DB] px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-[#0269AE] ">Create</button>
            </div>
    </form>



</section>


<?php require('components\loader.php') ?>



<script src="components\editPost\func.js"></script>
<script src="components\editPost\api.js"></script>
<script src="components\editPost\edit.js"></script>