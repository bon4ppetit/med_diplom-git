<script setup>
import {ref} from "vue";

let listRecords = ref();
function getOldRecords() {
    axios.get(route('get-old-records'))
        .then((res) => {
            listRecords.value = res.data
        })
}
getOldRecords();

</script>

<template>
    <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="text-[18px] font-bold text-slate-500">
            Ваши прошлые записи:
        </div>
        <br>
        <template v-for="record in listRecords">
            <div class="px-5 py-3 border-2 w-full flex mb-2 items-center justify-between max-w-[800px] m-auto">
                <div class="records_user-info flex flex-auto justify-between">
                    <div class="text-center mr-5">{{ record.surname }} {{ record.name }} {{ record.patronymic }}</div>
                    <div class="text-center"><span class="text-slate-500">Дата:</span> {{ record.record_date }}</div>
                    <div class="text-center"><span class="text-slate-500">Кабинет:</span> {{ record.number_room }}</div>
                    <div class="text-center"><span class="text-slate-500">Время:</span> {{ record.record_time }}</div>
                </div>
            </div>
        </template>
    </div>
</template>

<style scoped>
@media (max-width: 590px) {
    .records_user-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
    }
}
</style>
