<x-moonshine::table
    :simple="true"
    :columns="[
        '#', 'First', 'Last', 'Email'
    ]"
    :values="[
        [1, fake()->firstName(), fake()->lastName(), fake()->safeEmail()],
        [2, fake()->firstName(), fake()->lastName(), fake()->safeEmail()],
        [3, fake()->firstName(), fake()->lastName(), fake()->safeEmail()]
    ]"
/>
