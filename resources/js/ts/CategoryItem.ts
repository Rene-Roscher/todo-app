import TodoItem from "./TodoItem";

export default interface CategoryItem {
    id: string
    user_id: string
    name: string
    color: string
    order: number
    icon_path: string
    created_at: string
    updated_at: string
    todos: TodoItem[],
}