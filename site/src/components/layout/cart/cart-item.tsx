"use client";

import { ICartItem } from "@/interfaces/ICart";
import Image from "next/image";
import { useState } from "react";

interface CartItemProps {
  item: ICartItem;
  onUpdateQuantity: (productId: number, quantity: number) => void;
  onRemove: (productId: number) => void;
}

const CartItem = ({ item, onUpdateQuantity, onRemove }: CartItemProps) => {
  const [quantity, setQuantity] = useState(item.quantity);

  const handleQuantityChange = (newQuantity: number) => {
    if (newQuantity >= 1) {
      setQuantity(newQuantity);
      onUpdateQuantity(item.product.id_produto, newQuantity);
    }
  };

  return (
    <div className="flex items-center border-b border-gray-200 py-4">
      <div className="relative h-24 w-24">
        <Image
          src={`http://localhost:8081/produtos/imagens/${item.product.imagem}`}
          alt={item.product.produto}
          fill
          sizes="100%"
          className="object-cover border border-gray-300"
        />
      </div>
      <div className="flex-1 ml-4">
        <h3 className="text-lg font-semibold">{item.product.produto}</h3>
        <p className="text-gray-600">{item.product.marca}</p>
        <p className="text-gray-600">R$ {item.product.preco}</p>
      </div>
      <div className="flex items-center gap-2">
        <button
          onClick={() => handleQuantityChange(quantity - 1)}
          className="border border-gray-300 px-2 py-1 text-lg"
        >
          -
        </button>
        <span className="w-12 text-center">{quantity}</span>
        <button
          onClick={() => handleQuantityChange(quantity + 1)}
          className="border border-gray-300 px-2 py-1 text-lg"
        >
          +
        </button>
      </div>
      <div className="ml-4">
        <p className="text-lg font-semibold">
          R$ {item.product.preco * quantity}
        </p>
        <button
          onClick={() => onRemove(item.product.id_produto)}
          className="text-red-500 hover:underline mt-2"
        >
          Remover
        </button>
      </div>
    </div>
  );
};

export default CartItem;
