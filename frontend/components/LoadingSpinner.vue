<template>
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="relative w-32 h-32 flex">
            <SvgLadeanimationHaus class="absolute inset-0 h-32 w-32" :fontControlled="false" filled />
            <SvgLadeanimationPfeil class="absolute inset-0 h-32 w-32 animate-spin-reverse " :fontControlled="false" filled />
        </div>
    </div>
</template>
