<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <div>You need to be verified first to see this page</div>

    <div>
        <Link :href="route('verification.send')" method="post" as="button" class="text-indigo-600 dark:text-indigo-400">
        Resend Verification Email
        </Link>
    </div>
</template>