import DashboardButton from "@src/components/account/DashboardButton";
import route from "ziggy-js";


export default function DashboardDefault() {
    return <>
        <div className="w-full">
            <h4 className='text-2xl antialiased font-sans'>Il mio profilo</h4>
        </div>
        <div className='w-full flex flex-col md:flex-row md:space-x-4 space-y-4 md:space-y-0'>
            <DashboardButton title='Informazioni personali' link={route("account.informazioni-personali")} icon={<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                <path strokeLinecap="round" strokeLinejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>} />
            <DashboardButton title='Cambia password' link={route("account.cambia-password")} icon={<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                <path strokeLinecap="round" strokeLinejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
            </svg>
            } />
        </div>

    </>
}
