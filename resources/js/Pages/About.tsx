import { Head } from '@inertiajs/react';

export default function About() {
    return (
        <>
            <Head title="About" />
            <div className="flex flex-col items-center justify-center min-h-screen bg-gray-50 dark:bg-black">
                <h1 className="text-4xl font-bold text-black dark:text-white mb-4">About</h1>
                <p className="text-lg text-black/70 dark:text-white/70 max-w-xl text-center">
                    This is the About page. You can add more information about your application or team here.
                </p>`
            </div>`
        </>
    );
}

