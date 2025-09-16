<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
         <li>
            <a href="" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->is('courses*') ? 'bg-gray-200' : '' }}">
               <svg class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a8 8 0 100 16 8 8 0 000-16zM8 11V9h4v2H8z"/></svg>
               <span class="ms-3">Courses</span>
            </a>
         </li>
         <li>
            <a href="{{ route('lessons.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->is('lessons*') ? 'bg-gray-200' : '' }}">
               📖 <span class="ms-3">Lessons</span>
            </a>
         </li>
         <li>
            <button type="button" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="quiz-dropdown" data-collapse-toggle="quiz-dropdown">
               📝 <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Quizzes</span>
               <svg class="w-3 h-3" fill="none" viewBox="0 0 10 6"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1 5 5 1 1"/></svg>
            </button>
            <ul id="quiz-dropdown" class="hidden py-2 space-y-2">
               <li>
                  <a href="{{ route('admin.quizzes.index') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">All Quizzes</a>
               </li>
               <li>
                  <a href="{{ route('admin.questions.index',1) }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Questions</a>
               </li>
               <li>
                  <a href="{{ route('admin.options.index',1) }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Options</a>
               </li>
            </ul>
         </li>
      </ul>
   </div>
</aside>
