<template>
    <div class="border border-gray-200 dark:border-gray-800 rounded-md p-4 shadow-sm dark:text-gray-300">
        <div class="text-gray-500 forn-medium">
         <slot name="header"></slot>
        </div>
        <slot/>
    </div>
</template>