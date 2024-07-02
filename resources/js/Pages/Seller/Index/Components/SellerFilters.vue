<script setup>
import { reactive, watch, computed } from 'vue'
import { router } from '@inertiajs/vue3'
import { debounce } from 'lodash'

const props = defineProps({
    filters: Object
});

const filterForm = reactive({
    deleted: props.filters.deleted ?? false,
    by: props.filters.by ?? 'created_at',
    order: props.filters.order ?? 'desc'
})

const sortLabels = {
    created_at: [
        {
            label: 'Latest',
            value: 'desc'
        },
        {
            label: 'Oldest',
            value: 'asc'
        }
    ],
    price: [
        {
            label: 'Most Expensive',
            value: 'desc'
        },
        {
            label: 'Cheapest',
            value: 'asc'
        }
    ],
}

const sortOption = computed(() => sortLabels[filterForm.by])

watch(
    filterForm, debounce(() => router.get(
        route('seller.listing.index'),
        filterForm,
        { preserveState: true, preserveScroll: true }
    ), 1000)
)


</script>

<template>
    <form>
        <div class="mb-4 mt-4 flex flex-wrap  gap-4">
            <div class="flex flex-nowrap items-center gap-2">
                <input type="checkbox" id="deleted" v-model="filterForm.deleted"
                    class="h-4 w-4 rounded border-gray-300 text-gray-600 focus:ring-gray-500" />
                <label for="deleted">Recently deleted</label>
            </div>

            <div>
                <select class="input-filter-l w-24" v-model="filterForm.by">
                    <option value="created_at">Added</option>
                    <option value="price">Price</option>
                </select>
                <select class="input-filter-r 2-32" v-model="filterForm.order">
                    <option v-for="option in sortOption" :key="option.value" :value="option.value">
                        {{ option.label }}
                    </option>
                </select>
            </div>
        </div>
    </form>
</template>