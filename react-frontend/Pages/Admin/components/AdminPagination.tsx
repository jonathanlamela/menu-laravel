


export default function AdminPagination({ currentValue, onChangeHandler, pagesCount }: any) {


    const renderPage = (num: number) => {
        if (num == currentValue) {
            return <button key={num} onClick={(e) => { onChangeHandler(num); }} className="btn-secondary-outlined-active">{num}</button>
        } else {
            return <button key={num} onClick={(e) => { onChangeHandler(num); }} className="btn-secondary-outlined">{num}</button>
        }
    }

    const nextButton = () => {
        var num = currentValue + 1;

        if (num <= pagesCount) {
            return <button key={num} onClick={(e) => { onChangeHandler(num); }} className="btn-secondary-outlined">Prossima</button>

        } else {
            return <button disabled key={num} onClick={(e) => { onChangeHandler(num); }} className="btn-secondary-outlined">Prossima</button>
        }

    }

    const previuousButton = () => {
        var num = currentValue - 1;

        if (num > 0) {
            return <button key={num} onClick={(e) => { onChangeHandler(num); }} className="btn-secondary-outlined" >Precedente</button>
        } else {
            return <button disabled key={num} onClick={(e) => { onChangeHandler(num); }} className="btn-secondary-outlined">Precedente</button>
        }

    }

    return <>
        <div className="flex flex-row space-x-2 h-10">
            {previuousButton()}
            {[...Array(pagesCount)].map((num: number, index: number) => renderPage(index + 1))}
            {nextButton()}
        </div>
    </>
}
