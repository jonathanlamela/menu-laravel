
import { Message } from "@src/types";
import { usePage } from "@inertiajs/react";


export default function Messages() {

    const page = usePage<{ message: Message }>();
    const { message } = page.props;



    if (message != null) {

        const { type, text } = message;


        console.log(type);

        switch (type) {
            case "success":
                return <>
                    <div className="pb-4">
                        <div className="bg-lime-700/25 border-l-lime-700 border-l-8 p-4 text-green-900">
                            <span>{text}</span>
                        </div>
                    </div>
                </>

            case "error":
                return <>
                    <div className="pb-4">
                        <div className="bg-red-700/25 border-l-red-700 border-l-8 p-4 text-red-900">
                            <span>{text}</span>
                        </div>
                    </div>
                </>
            case "info":
                return <>
                    <div className="pb-4">
                        <div className="bg-gray-400/25 border-l-gray-700 border-l-8 p-4 text-gray-900">
                            <span>{text}</span>
                        </div>
                    </div>
                </>
        }
    }

    return null;





}
