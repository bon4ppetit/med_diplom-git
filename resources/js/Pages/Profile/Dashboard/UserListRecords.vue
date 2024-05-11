<script setup>
import CreateRecordPanel from "@/Pages/Profile/Dashboard/CreateRecordPanel.vue";
import Modal from "@/Components/Modal.vue";
import {ref} from "vue";
import {list} from "postcss";
import {data} from "autoprefixer";

let listRecords = ref();

function getAllRecords() {
    axios.get(route('get-user-records'))
        .then((res) => {
            console.log(res.data)
            listRecords.value = res.data;
        })
        .catch(() => {
        })
}
getAllRecords();

let viewModal = ref(false);

function deleteRecord(id) {
    axios.post(route('delete-record'), {id: id})
        .then((res) => {
            location.reload()
        })
}

</script>

<template>
<div class="p-6 text-gray-900 flex flex-col">
        <div class="flex justify-between mb-6">
            <h3 class="font-bold text-xl text-slate-500 ">
                Ваши текущие записи
            </h3>
            <button @click="viewModal = true" class="button_create-record text-white flex-end bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Записаться на приём
            </button>
        </div>
            <template v-for="record in listRecords">
                <div class="records_user-block w-full px-5 py-3 border-2 flex mb-2 items-center justify-between max-w-[800px] m-auto">
                    <div class="records_user-info flex flex-auto justify-between">
                        <div class="text-center mr-3">{{ record.surname }} {{ record.name }} {{ record.patronymic }}</div>
                        <div class="text-center mr-2"><span class="text-slate-500">Дата:</span> {{ record.record_date }}</div>
                        <div class="text-center mr-2"><span class="text-slate-500">Кабинет:</span> {{ record.number_room }}</div>
                        <div class="text-center mr-2"><span class="text-slate-500">Время:</span> {{ record.record_time }}</div>
                    </div>

                    <div class="item-end">
                        <button v-on:click="deleteRecord(record.id)" class="px-5 py-1 bg-red-500 text-slate-50 rounded-[4px]">Отменить</button>
                    </div>
                </div>
            </template>
    <Modal :show="viewModal" v-on:close="viewModal = false">
        <CreateRecordPanel></CreateRecordPanel>
    </Modal>

</div>
</template>

<style scoped>
@media (max-width: 590px) {
    .records_user-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
        align-items: center;
        grid-template-rows: 50px 50px;
        justify-content: center;
    }
}
@media (max-width: 490px) {
    .records_user-block {
        flex-direction: column;
    }
    .records_user-info {

    }
}
@media (max-width: 370px) {
    .button_create-record {
        font-size: 13px;
        padding: 4px 8px;
        line-height: 15px;
    }
}
</style>
