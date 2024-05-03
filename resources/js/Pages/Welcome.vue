<script setup>
import { Head } from '@inertiajs/vue3';
import Image from "@/Components/Image.vue";
import NavLink from "@/Components/NavLink.vue";
import {ref} from "vue";
import {list} from "postcss";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    }
});

let listDoctors = ref();

function getDoctors(listDoctors) {
    axios.get(route('get-all-doctors'))
        .then((res) => {
            listDoctors.value = res.data
        })
}
getDoctors(listDoctors);



</script>

<template>
    <Head title="Добро пожаловать" />
    <header class="max-w-[1100px] m-auto flex justify-between items-center min-h-[80px] mb-10 px-3">
        <h1 class="text-center text-2xl text-slate-600 font-bold">Диагностика <span class="text-blue-700">Плюс</span></h1>
        <div class="small_price font-bold text-center">
            <div class="text-xl text-cyan-500">Скидка <span class="text-red-500">15%</span></div>
            <div class="text-slate-600">До 25 апреля</div>
        </div>
    </header>
    <main class="max-w-[1100px] m-auto flex flex-col justify-center items-center min-h-[80px]">
        <div class="block-2 p-[10px] w-full">
            <div class="mb-10">
                <p class="text-xl text-slate-600 font-bold">
                    Мы позаботимся о вашем здоровье
                </p>
                <div class="box-1 flex justify-between items-center">
                    <div class="box-1-item min-h-[130px] flex flex-col justify-between">
                        <p class="px-[15px] mb-5">
                            Будьте <span class="text-blue-700">уверены в своем</span> здоровье и <span class="text-blue-700">здоровье</span> вашего <span class="text-blue-700">близкого</span>.
                            <br>Стамотологи, хирурги, терапевты и ещё более 20 направлений!
                            <br>Пройдите нужные вам анализы быстро и без переплат.
                        </p>
                        <p>
                            <a class="text-button-align bg-blue-700 px-5 py-3 mr-2 text-white rounded-[10px]" :href="route('login')">Запишитесь</a> к нам на приём уже сегодня
                        </p>
                    </div>
                    <div class="max-w-xs p-2 border-2 rounded-[10px] border-blue-500">
                        <Image class="w-full rounded-[10px]" :pathImage="'welcome_page/1.jpg'"></Image>
                    </div>
                </div>
            </div>
            <div class="min-h-[300px] text-slate-600 mb-[60px]">
                <p class="text-xl mb-[25px]">
                    Только лицензированые профессионалы своего дела <span class="font-bold">со стажем от 4х лет</span>
                </p>

                <div class="flex gap-4 overflow-y-scroll">
                    <div v-for="doctor in listDoctors" class="max-w-[200px]">
                        <div class="flex flex-col gap-1  max-w-[200px]">
                            <div class="">
                                <img class="max-w-[200px] h-[272px] rounded-[10px]" :src="'storage/doctors_photo/'+doctor.avatar_photo+'.jpg'">
                            </div>
                            <div class="px-3">
                                <div class="text-[15px] flex justify-between mb-3">
                                    <div class="">{{doctor.name}}</div>
                                    <div class="font-bold">
                                        <span class="text-blue-700">10 лет</span> опыта
                                    </div>
                                </div>
                                <p class="text-sm">
                                    {{doctor.profession}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="min-h-[300px] text-slate-600 mb-[60px]">
                <p class="text-xl mb-[25px]">
                    Получайте только <span class="font-bold">качественное</span> обслуживание по выгодным ценам
                </p>
                <div class="box-3 p-6 flex justify-between">
                    <div class="box-3-item max-w-[300px]">
                        <div class="p-0 mb-4">
                            <img src="storage/welcome_page/2.jpg" class="w-full rounded-[10px] max-w-[400px]" alt="">
                        </div>
                        <h2 class="font-bold mb-3 ">
                            Профессионализм
                        </h2>
                        <p>Врачебный состав нашей клиники - высококвалифицированные специалисты, проходящие повышение и подтверждение квалификации</p>
                    </div>
                    <div class="box-3-item max-w-[300px]">
                        <div class="p-0 mb-4">
                            <img src="storage/welcome_page/2.jpg" class="img w-full rounded-[10px] max-w-[400px]" alt="">
                        </div>
                        <h2 class="font-bold mb-3 ">
                            Оборудование
                        </h2>
                        <p>Клиника использует современное передовое оборудование</p>
                    </div>
                    <div class="box-3-item max-w-[300px]">
                        <div class="p-0 mb-4">
                            <img src="storage/welcome_page/2.jpg" class="img w-full rounded-[10px] max-w-[400px]" alt="">
                        </div>
                        <h2 class="font-bold mb-3 ">
                            Уникальность
                        </h2>
                        <p>Программы лечения разработаны ведущими специалистами Израиля</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer text-slate-600 mb-[60px]">
            <h3 class="footer-text text-xl">Подберите нужного вам врача и <a class="bg-blue-700 px-5 py-3 mr-2 text-base text-white rounded-[10px]" :href="route('login')">Запишитесь</a>на прием <span class="font-bold">онлайн</span></h3>
        </div>
    </main>
</template>

<style>


@media (max-width: 700px) {
    .box-1 {
        margin-top: 20px;
        flex-direction: column;
    }
    .box-1-item {
        margin-bottom: 30px;
    }
}
@media (max-width: 975px) {
    .box-3-item {
        max-width: 230px;
    }
}
@media (max-width: 765px) {
    .box-3 {
        flex-direction: column;
        align-items: center;

    }
    .box-3-item {
        max-width: 450px;
        margin-bottom: 23px;
    }
}
@media (max-width: 640px) {
    .footer {
        padding: 0 15px 0 15px;
    }
}
@media (max-width: 500px) {
    .footer-text {
        text-align: center;
        font-size: 18px;
        line-height: 40px;
    }
}
@media (max-width: 400px) {
    .small_price div {
        font-size: 15px;
    }
    .text-button-align {
        text-align: center;
        font-size: 14px;
        line-height: 40px;
    }
}

</style>
